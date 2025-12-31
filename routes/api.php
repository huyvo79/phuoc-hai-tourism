<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Api\UserController;

Route::prefix('admin')->group(function () {

    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('logout', [AuthController::class, 'logout']);

        Route::get('profile', function (Request $request) {
            return $request->user();
        });

        // Tự động tạo route: PUT /users/{user}
        Route::apiResource('users', UserController::class);

    });
});

