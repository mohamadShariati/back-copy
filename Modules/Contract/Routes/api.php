<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Contract\Http\Controllers\ContractController;
use Modules\Contract\Http\Controllers\ContractReportController;

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

// Route::middleware('auth:api')->get('/contract', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->prefix('contract')->group(function(){

    Route::get('/',[ContractController::class,'index'])->name('contract.index');
    Route::get('/create',[ContractController::class,'create'])->name('contract.create');
    Route::post('/store',[ContractController::class,'store'])->name('contract.store');
    Route::get('/edit/{contract}',[ContractController::class,'edit'])->name('contract.edit');
    Route::post('/update/{contract}',[ContractController::class,'update'])->name('contract.update');
    Route::delete('/destroy/{contract}',[ContractController::class,'destroy'])->name('contract.destroy');

    Route::prefix('report')->group(function () {
    Route::get('/',[ContractReportController::class,'index'])->name('contract.report.index');
    Route::get('/create',[ContractReportController::class,'create'])->name('contract.report.create');
    Route::post('/store',[ContractReportController::class,'store'])->name('contract.report.store');
    Route::get('/edit/{contractReport}',[ContractReportController::class,'edit'])->name('contract.report.edit');
    Route::post('/update/{contractReport}',[ContractReportController::class,'update'])->name('contract.report.update');
    Route::delete('/destroy/{contractReport}',[ContractReportController::class,'destroy'])->name('contract.report.destroy');
    });
});