<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsulanController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usulans', [UsulanController::class, 'index']);
    Route::post('/usulans', [UsulanController::class, 'store']);
    Route::put('/usulans/{id}', [UsulanController::class, 'update']);
    Route::delete('/usulans/{id}', [UsulanController::class, 'destroy']);
});
