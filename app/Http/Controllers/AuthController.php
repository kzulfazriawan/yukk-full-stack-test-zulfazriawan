<?php

namespace App\Http\Controllers;

use App\Mail\MailVerification;
use App\Models\Balances;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    /**
     * View Authentication
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function authentication(){
        return view('auth.index');
    }

    public function verification(){
        $show_url = env('APP_SHOW_VERIFICATION_URL');
        return view('auth.verification', ['show_url' => $show_url]);
    }

    /**
     * Generate Authorized Token
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createToken(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->where('is_active', 1)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response(['token' => $user->createToken($user->email)->plainTextToken], 200);
    }

    /**
     * Register a new User
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createUser(Request $request){
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::where('email', $request->email)->first();

        if($user){
            throw ValidationException::withMessages([
                'email' => ['Email has been taken.'],
            ]);
        }
        
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $uid = base64_encode(bcrypt($user->uuid));

        if (!env('APP_SHOW_VERIFICATION_URL')){
            Mail::to($request->email)->send(
                new MailVerification(env('APP_URL') . '/verification?token=' . $uid . '&email=' . $user->email)
            );
        }

        return response(['email' => $user->email, 'verify' => $uid], 200);
    }

    /**
     * Verify new user
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function verifyUser(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required',
        ]);

        $uuid = base64_decode($request->token);
        $user = User::where('email', $request->email)->first();
        
        if(! $user || ! Hash::check($user->uuid, $uuid) || !is_null($user->email_verified_at)){
            throw ValidationException::withMessages([
                'email' => ['Verification email invalid.'],
            ]);
        }

        $user->is_active = 1;
        $user->email_verified_at = Carbon::now();
        $user->save();

        $balance = new Balances();
        $balance->user_id = $user->id;
        $balance->amount  = 0;
        $balance->save();

        return response(['email' => $user->email, 'is_active' => $user->is_active], 200);
    }
}
