<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::prefix('manager')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('messages', MessageController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
