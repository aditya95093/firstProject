<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/users',[AuthController::class, 'index']);
Route::post('/users/register',[AuthController::class, 'register']);
Route::post('/users/login',[AuthController::class, 'login']);
Route::post('/users/logout',[AuthController::class, 'logout']);
Route::put('/users/edit/{id}', [AuthController::class, 'edit']);
Route::delete('/users/edit/{id}', [AuthController::class, 'delete']);
