<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\ResponseController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::get('/categories', [CategoryController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        Route::apiResource('complaints', ComplaintController::class);
        Route::get('/complaints/{complaint}/responses', [ResponseController::class, 'index']);

        Route::middleware('role:admin')->group(function () {
            Route::get('/admin/complaints', [ComplaintController::class, 'adminIndex']);
            Route::patch('/admin/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus']);
            Route::post('/categories', [CategoryController::class, 'store']);
            Route::put('/categories/{category}', [CategoryController::class, 'update']);
            Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
            Route::post('/complaints/{complaint}/responses', [ResponseController::class, 'store']);
        });
    });
});
