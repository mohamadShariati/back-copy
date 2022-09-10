<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Request\Http\Controllers\RequestController;
use Modules\Request\Http\Controllers\RequestLogController;

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

Route::middleware('auth:api')->get('/request', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('request')->group(function(){

    Route::get('/',[RequestController::class,'index'])->name('request.index');
    Route::get('/create',[RequestController::class,'create'])->name('request.create');
    Route::post('/store',[RequestController::class,'store'])->name('request.store');
    Route::get('/edit/{entitiesRequest}',[RequestController::class,'edit'])->name('request.edit');
    Route::post('/update/{entitiesRequest}',[RequestController::class,'update'])->name('request.update');
    Route::delete('/delete/{entitiesRequest}',[RequestController::class,'destroy'])->name('request.destroy');

    Route::prefix('log')->group(function () {
    Route::get('/',[RequestLogController::class,'index'])->name('request.log.index');
    Route::get('/create',[RequestLogController::class,'create'])->name('request.log.create');
    Route::post('/store',[RequestLogController::class,'store'])->name('request.log.store');
    Route::get('/edit/{requestLog}',[RequestLogController::class,'edit'])->name('request.log.edit');
    Route::post('/update/{requestLog}',[RequestLogController::class,'update'])->name('request.log.update');
    Route::delete('/delete/{requestLog}',[RequestLogController::class,'destroy'])->name('request.log.destroy');
    });

});