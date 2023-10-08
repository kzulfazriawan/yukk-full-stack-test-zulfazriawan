<?php

namespace App\Http\Controllers;

use App\Models\Balances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function balances(){
        return Balances::where('user_id', auth()->user()->id)->first();
    }
}
