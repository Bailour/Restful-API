<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/users', [UserController::class,'index'])->middleware('auth:sanctum');
Route::post('/users', [UserController::class,'store'])->middleware('auth:sanctum');;
Route::post('/login', [UserController::class,'login']);
Route::put('/users/{id}', [UserController::class,'update'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [UserController::class,'delete'])->middleware('auth:sanctum');