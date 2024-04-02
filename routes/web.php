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
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'root'])->name('root');


Route::group(['middleware' => ['auth']], function() {

    Route::group(['prefix' => 'user_management'], function () {
        Route::resource('roles', \App\Http\Controllers\RoleController::class);
        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    });

    Route::group(['prefix' => 'account'], function () {
        Route::resource('profile', \App\Http\Controllers\Account\ProfileController::class);
    });

    Route::group(['prefix' => 'product_management'], function (){
        Route::resource('product', \App\Http\Controllers\ProductController::class);
    });

    Route::group(['prefix' => ''], function (){
        Route::resource('leads', \App\Http\Controllers\LeadsController::class);
    });

    Route::group(['prefix' => 'sale_management'], function (){
        Route::resource('customer', \App\Http\Controllers\CustomerController::class);
        Route::resource('estimate', \App\Http\Controllers\EstimateController::class);
        Route::resource('orders', \App\Http\Controllers\SalesOrderController::class);
        Route::resource('invoice', \App\Http\Controllers\InvoiceController::class);
    });

    Route::group(['prefix' => 'purchase_manage'], function (){
        Route::resource('vendors', \App\Http\Controllers\VendorController::class);
        Route::resource('purchaseorders', \App\Http\Controllers\PurchaseOrderController::class);
    });

    Route::group(['prefix' => 'settings'], function (){
        Route::resource('organization', \App\Http\Controllers\Settings\OrganizationController::class)->names('settings.organization');
        Route::resource('taxrates', \App\Http\Controllers\Settings\TaxRatesController::class)->names('settings.taxrates');
        Route::resource('taxrates_group', \App\Http\Controllers\Settings\TaxRateGroupController::class)->names('settings.taxrates_group');
        Route::resource('taxrates_default', \App\Http\Controllers\Settings\TaxRatesDefaultController::class)->names('settings.taxrates_default');
        Route::resource('currency', \App\Http\Controllers\Settings\CurrencyController::class)->names('settings.currency');
        Route::resource('placeofsupply', \App\Http\Controllers\Settings\PlaceOfSupplyController::class)->names('settings.placeofsupply');
    });



});

Route::group(['prefix' => 'web-apis'], function (){
    Route::get('getProductDetails', [\App\Http\Controllers\AjaxAPIController::class,'getProductDetails']);
    Route::get('getCustomerDetails', [\App\Http\Controllers\AjaxAPIController::class,'getCustomerDetails']);
});

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


