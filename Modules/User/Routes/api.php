<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

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

Route::prefix('user')->group(function(){
    Route::post('/register',[UserController::class,'register'])->name('user.register');
    Route::post('/login',[UserController::class,'login'])->name('user.login');
    Route::middleware('auth:sanctum')->get('/all', [UserController::class,'all'])->name('user.all');
});

Route::get('user/test', [UserController::class,'test']);