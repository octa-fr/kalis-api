<?php

use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProCategoryController;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::apiResource('exercises', ExerciseController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('pro-categories', ProCategoryController::class);