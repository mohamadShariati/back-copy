<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\BaseProduct\Http\Controllers\BaseProductController;

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

Route::middleware('auth:api')->get('/baseproduct', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('base-product')->group(function(){
   Route::get('/', [BaseProductController::class,'index'])->name('base-product.index');
   Route::get('/create', [BaseProductController::class,'create'])->name('base-product.create');
   Route::post('/store',[BaseProductController::class,'store'])->name('base-product.store');
   Route::get('/edit/{baseProduct}',[BaseProductController::class,'edit'])->name('base-product.edit');
   Route::post('/update/{baseProduct}',[BaseProductController::class,'update'])->name('base-product.update');
   Route::delete('/destroy/{baseProduct}',[BaseProductController::class,'destroy'])->name('base-product.destroy');
});

Route::get('/baseproduct/test',[BaseProductController::class,'test']);