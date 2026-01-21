<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmergencyController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PostImageController;

Route::get('/posts/search', [IndexController::class, 'search']);

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
    Route::apiResource('post-images', PostImageController::class);
});

Route::get('/reset-admin', [EmergencyController::class, 'resetAdmin']);
//  /api/reset-admin?key=phuochai
Route::middleware(['track.visitor'])->group(function () {

    Route::get('/posts', [PostController::class, 'index']);

    Route::get('/posts/{id}', [PostController::class, 'show']);
});

Route::get('/category', [IndexController::class, 'indexCategories']);
Route::get('/posts', [IndexController::class, 'indexWithoutPagination']);

