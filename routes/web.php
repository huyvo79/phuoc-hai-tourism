<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;

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
        Route::get('categories', function () {
            return view('admin.category.indexCategory');
        })->name('category.list');
    });
});
Route::get('/single', [App\Http\Controllers\IndexController::class, 'single'])->name('single');

