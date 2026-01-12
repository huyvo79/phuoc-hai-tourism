<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('ui-index.index');
})->middleware('track.visitor');

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

        Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');

        Route::put('categories/{id}', [CategoryController::class, 'update'])->name('category.update');

        Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});
Route::get('/single', [App\Http\Controllers\IndexController::class, 'single'])->name('single'); 
Route::get('/contact', [App\Http\Controllers\IndexController::class, 'contact'])->name('home.contact');
Route::get('/home', [App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/news', [App\Http\Controllers\IndexController::class, 'news'])->name('home.news');
Route::get('/events', [App\Http\Controllers\IndexController::class, 'events'])->name('home.events');
Route::get('/plan', [App\Http\Controllers\IndexController::class, 'plan'])->name('home.plan');
Route::get('/explore', [App\Http\Controllers\IndexController::class, 'explore'])->name('home.explore');
Route::get('/single', [App\Http\Controllers\IndexController::class, 'single'])->name('single')->middleware('track.visitor');
Route::get('/archive', [App\Http\Controllers\IndexController::class, 'archive'])->name('archive');

