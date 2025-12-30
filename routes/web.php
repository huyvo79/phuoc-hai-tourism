<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

// Route cho Guest (Chưa đăng nhập)
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
});

// Route cho Admin (Đã đăng nhập - cần Middleware auth)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Trang Dashboard sau khi đăng nhập thành công
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('users', function () {
        return view('crud-user.list'); 
    })->name('admin.users.index');

    // Đăng xuất
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
});
