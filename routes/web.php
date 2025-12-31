<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    
    Route::middleware('admin.guest')->group(function () {
        Route::get('login', fn() => view('admin.auth.login'))->name('admin.login');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::get('dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    });
});
