<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getInfo',[\App\Http\Controllers\InfoController::class,'getInfo'])->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);
Route::get('/getNick',[\App\Http\Controllers\InfoController::class,'getMachine'])->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);


