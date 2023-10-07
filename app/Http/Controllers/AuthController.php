<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    /**
     * View Authentication
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        return view('auth.index');
    }

    public function verification(){
        return view('auth.verification');
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
        
        return response(['email' => $user->email, 'name' => $user->name, 'uuid' => $user->id], 200);
    }
}
