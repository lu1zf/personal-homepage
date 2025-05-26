<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/session', [SessionController::class, 'create']);
Route::delete('/session', [SessionController::class, 'delete'])->middleware('auth:sanctum');

Route::resource('boards', BoardController::class)->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
