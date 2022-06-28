<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class, 'index']);
    Route::post('user/create', [UserController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::post('user/update/{id}', [UserController::class, 'update']);
    Route::get('user/delete/{id}', [UserController::class, 'destroy']);

    Route::post('logout', [RegisterController::class, 'logout']);

    Route::get('customer', [CustomerController::class, 'index']);
    Route::post('customer/create', [CustomerController::class, 'store']);
    Route::get('customer/{id}', [CustomerController::class, 'show']);
    Route::post('customer/update/{id}', [CustomerController::class, 'update']);
    Route::get('customer/delete/{id}', [CustomerController::class, 'destroy']);
});

// Route::middleware('auth:api')->group(function () {
//     Route::resource('customer', CustomerController::class);
// });

// Route::post('/register', [RegisterController::class, 'register']);
// Route::post('/login', [RegisterController::class, 'login']);
// Route::post('/logout', [RegisterController::class, 'logout'])->middleware('auth:api');
