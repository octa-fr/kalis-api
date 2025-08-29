<?php

use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProCategoryController;

Route::apiResource('exercises', ExerciseController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('pro-categories', ProCategoryController::class);
