<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the 'api' middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'createToken']);
    Route::post('register', [AuthController::class, 'createUser']);
    Route::post('verification', [AuthController::class, 'verifyUser']);

    Route::resource('services', ServicesController::class)->only([
        'index'
    ]);

    Route::middleware('auth:sanctum')->resource('transactions', TransactionsController::class)->only([
        'index', 'store', 'update', 'show'
    ]);

    Route::middleware('auth:sanctum')->prefix('user')->group(function () {
        Route::get('balance', [UserController::class, 'balances']);
    });
});