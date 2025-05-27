<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/session', [SessionController::class, 'create']);

Route::middleware(['auth:sanctum',])->group(function () {
    Route::delete('/session', [SessionController::class, 'delete']);

    Route::resource('boards', BoardController::class);
    Route::resource('boards.blocks', BlockController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
