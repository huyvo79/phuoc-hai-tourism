<?php

use Illuminate\Support\Facades\Route;

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
    });
});
Route::get('/single', [App\Http\Controllers\IndexController::class, 'single'])->name('single');
