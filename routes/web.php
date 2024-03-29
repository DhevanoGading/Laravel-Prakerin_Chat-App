<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Route::resource('customer', CustomerController::class);
// Route::get('/customer/{id}', [CustomerController::class, 'show']);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'ceklevel:superadmin']], function () {
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy']);
});

Route::group(['middleware' => ['auth', 'ceklevel:admin,superadmin']], function () {
    Route::get('/customer/create', [CustomerController::class, 'create']);
    Route::post('/customer', [CustomerController::class, 'store']);
    Route::put('/customer/{id}', [CustomerController::class, 'update']);
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit']);
});

Route::group(['middleware' => ['auth', 'ceklevel:admin,superadmin,user']], function () {
    Route::get('/customer', [CustomerController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {
    Route::get('/service/admin/{id?}', [ServiceController::class, 'index'])->name('service/admin');
});

Route::group(['middleware' => ['auth', 'ceklevel:user']], function () {
    Route::get('/service/user/{id?}', [ServiceController::class, 'indexUser'])->name('service/user');
});

// Route::group(['middleware' => 'super_admin'], function () {
//     Route::delete('/customer/{id}', [CustomerController::class, 'destroy']);
// });

// Route::group(['middleware' => 'admin|super_admin'], function () {
//     Route::get('/customer/create', [CustomerController::class, 'create']);
//     Route::post('/customer', [CustomerController::class, 'store']);
//     Route::put('/customer/{id}', [CustomerController::class, 'update']);
//     Route::get('/customer/{id}/edit', [CustomerController::class, 'edit']);
// });


// Route::group(['middleware' => 'user' || 'admin' || 'super_admin'], function () {
// });
