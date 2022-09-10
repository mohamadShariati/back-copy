<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Role\Http\Controllers\RoleController;

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

Route::middleware('auth:api')->get('/role', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('role')->group(function () {
    Route::get('/',[RoleController::class,'index'])->name('role.index');
    Route::get('/create',[RoleController::class,'create'])->name('role.create');
    Route::post('/store',[RoleController::class,'store'])->name('role.store');
    Route::get('/edit/{role}',[RoleController::class,'edit'])->name('role.edit');
    Route::post('/update/{role}',[RoleController::class,'update'])->name('role.update');
    Route::delete('/delete/{role}',[RoleController::class,'destroy'])->name('role.destroy');
});