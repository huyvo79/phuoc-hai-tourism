<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Chỉ dùng để hiển thị giao diện HTML)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Nhóm Admin
Route::prefix('admin')->group(function () {
    
    Route::get('login', function () {
        return view('admin.auth.login');
    })->name('login'); 

    Route::get('dashboard', function () {
        return view('admin.dashboard');
    });
});
