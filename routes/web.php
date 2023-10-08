<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/auth', [AuthController::class, 'authentication']);
Route::get('/verification', [AuthController::class, 'verification']);
Route::get('/transactions', [HomeController::class, 'transactions']);
Route::get('/transactions/detail/{id}', [HomeController::class, 'transactionDetail']);
Route::get('/transactions/create', [HomeController::class, 'transactionCreate']);
