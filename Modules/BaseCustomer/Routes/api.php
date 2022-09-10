<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\BaseCustomer\Http\Controllers\BaseCustomerController;
use Modules\BaseCustomer\Http\Controllers\PaymentController;

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

Route::middleware('auth:api')->get('/basecustomer', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('base-customer')->group(function () {
    Route::get('/', [BaseCustomerController::class, 'index'])->name('base-customer.index');
    Route::get('/create', [BaseCustomerController::class, 'create'])->name('base-customer.create');
    Route::post('/store', [BaseCustomerController::class, 'store'])->name('base-customer.store');
    Route::get('/edit/{baseCustomer}', [BaseCustomerController::class, 'edit'])->name('base-customer.edit');
    Route::post('/update/{baseCustomer}', [BaseCustomerController::class, 'update'])->name('base-customer.update');
    Route::delete('/destroy/{baseCustomer}', [BaseCustomerController::class, 'destroy'])->name('base-customer.destroy');

    Route::prefix('payment')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('base-customer.payment.index');
        Route::get('/create', [PaymentController::class, 'create'])->name('base-customer.payment.create');
        Route::post('/store', [PaymentController::class, 'store'])->name('base-customer.payment.store');
        Route::get('/edit/{payment}', [PaymentController::class, 'edit'])->name('base-customer.payment.edit');
        Route::post('/update/{payment}', [PaymentController::class, 'update'])->name('base-customer.payment.update');
        Route::delete('/destroy/{payment}', [PaymentController::class, 'destroy'])->name('base-customer.payment.destroy');
    });
});
