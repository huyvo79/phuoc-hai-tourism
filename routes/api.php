<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmergencyController;
use App\Http\Controllers\Api\DashboardController;

Route::get('/posts/search', [PostController::class, 'search']);

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['jwt.cookie', 'auth:api'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::middleware(['jwt.cookie', 'auth:api'])->group(function () {
    Route::get('/dashboard/stats', [DashboardController::class, 'index']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('categories', CategoryController::class);
});

Route::get('/reset-admin', [EmergencyController::class, 'resetAdmin']);
//  /api/reset-admin?key=phuochai
Route::middleware(['track.visitor'])->group(function () {

    Route::get('/posts', [PostController::class, 'index']);

    Route::get('/posts/{id}', [PostController::class, 'show']);
});

// Lấy danh sách Categories và Posts (Public)
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

Route::get('/posts', [PostController::class, 'indexWithoutPagination']);
Route::get('/posts/{id}', [PostController::class, 'show']);

