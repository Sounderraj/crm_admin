<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

Route::group(['middleware' => ['auth']], function() {

    Route::group(['prefix' => 'user_management'], function () {
        Route::resource('roles', \App\Http\Controllers\RoleController::class);
        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    });

    Route::group(['prefix' => 'masters'], function (){
        Route::resource('customer', \App\Http\Controllers\CustomerController::class);
    });

    Route::group(['prefix' => 'product_management'], function (){
        Route::resource('product', \App\Http\Controllers\ProductController::class);
    });

    Route::group(['prefix' => ''], function (){
        Route::resource('leads', \App\Http\Controllers\LeadsController::class);
    });

    Route::group(['prefix' => 'sale_management'], function (){
        Route::resource('estimate', \App\Http\Controllers\EstimateController::class);
        Route::resource('invoice', \App\Http\Controllers\InvoiceController::class);
    });
    



});

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
