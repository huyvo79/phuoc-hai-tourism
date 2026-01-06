<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('ui-index.index');
});

Route::prefix('admin')->group(function () {

    Route::middleware('admin.guest')->group(function () {
        Route::get('login', fn() => view('admin.auth.login'))->name('admin.login');
    });

    Route::middleware('admin.auth')->group(function () {
        // Route::get('dashboard', fn() => view('layouts.dashboard'))->name('dashboard');

        Route::get('dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

        Route::get('users', fn() => view('crud-user.list'))->name('user.list');

        Route::resource('posts', PostController::class);

        //category
        Route::get('categories', [CategoryController::class, 'index'])->name('category.list');

        Route::get('categories/create', [CategoryController::class, 'create'])->name('category.create');

        Route::post('categories', [CategoryController::class, 'store'])->name('category.store');
    });
});
Route::get('/single', [App\Http\Controllers\IndexController::class, 'single'])->name('single');

