<?php

use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [AuthController::class, 'index']);
    Route::delete('/users/{id}', [AuthController::class, 'destroy']);
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::apiResource('exercises', ExerciseController::class);
Route::apiResource('categories', CategoryController::class);