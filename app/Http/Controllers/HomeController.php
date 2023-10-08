<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return view("home.index");
    }

    public function transactions(){
        return view('transactions.index');
    }

    public function transactionDetail($id){
        return view('transactions.detail', ['uid' => $id]);
    }

    public function transactionCreate(){
        return view('transactions.create');
    }
}
