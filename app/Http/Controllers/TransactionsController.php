<?php

namespace App\Http\Controllers;

use App\Models\Balances;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransactionsController extends Controller
{
    private $limit = 10;

    private Balances $balances;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $this->balances = Balances::where('user_id', $user->id)->first();

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $transaction = Transactions::where('user_id', $user->id);

        if ( $request->status )
            $transaction->where('status', $request->status);

        if ( $request->income )
            $transaction->where('is_income', ($request->income == 'in') ? true : false);

        if ( $request->page )
            return $transaction->orderBy('created_at')->paginate($this->limit);

        return $transaction->orderBy('created_at')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required',
            'amount'     => 'required',
            'service_id' => 'required',
            'type'       => 'required'
        ]);

        if ( $this->balances->amount < $request->input('amount')){
            throw ValidationException::withMessages([
                'amount' => ['The balances is less than transaction amount.'],
            ]);
        }

        $user = auth()->user();
        $transaction = new Transactions();
        $transaction->title      = $request->input('title');
        $transaction->amount     = $request->input('amount');
        $transaction->service_id = $request->input('service_id');
        $transaction->user_id    = $user->id;
        $transaction->status     = 'open';
        $transaction->is_income  = ($request->input('type') == 'topup') ? true : false ;
        $transaction->remarks    = (!is_null($request->input('remarks'))) ? $request->input('remarks') : '';
        $transaction->save();

        return response(['id' => $transaction->id], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = auth()->user();
        return Transactions::where('id', $id)->where('user_id', $user->id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $user = auth()->user();
        $transaction = Transactions::where('id', $id)->where('status', 'open')->where('user_id', $user->id)->first();
        if(! $transaction ){
            throw ValidationException::withMessages([
                'status' => ['The provided transactions are incorrect.'],
            ]);
        }
        $transaction->status = (Carbon::now()->gt($transaction->expiry)) ? 'expired' : $request->input('status');
        $transaction->save();

        $this->balances->amount = ($transaction->is_income) ? $this->balances->amount + $transaction->amount : $this->balances->amount - $transaction->amount;
        $this->balances->save();

        return response(['id' => $transaction->id], 200);
    }
}
