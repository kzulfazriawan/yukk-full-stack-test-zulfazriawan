<?php

namespace App\Http\Controllers;

use App\Models\Balances;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function balances(){
        return Balances::where('user_id', auth()->user()->id)->first();
    }

    public function index(){
        return Auth::user();
    }

    public function update(Request $request){
        $request->validate([
            'password' => 'confirmed|min:8'
        ]);

        $user = User::where('id', auth()->user()->id)->first();
        $user->name = (!is_null($request->input('name'))) ? $request->input('name') : $user->name;

        if (!is_null($request->input('password')))
            $user->password = bcrypt($request->input('password'));

        $user->save();

        return response([$user], 200);
    }
}
