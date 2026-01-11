<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('ui-index.index');
})->middleware('track.visitor');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::middleware('admin.guest')->group(function () {
            Route::get('login', fn() => view('admin.auth.login'))
                ->name('login');
        });

        Route::middleware('admin.auth')->group(function () {

            Route::get('dashboard', fn() => view('admin.dashboard'))
                ->name('dashboard');

            Route::get('users', fn() => view('crud-user.list'))
                ->name('users.list');

            // POSTS
            Route::resource('posts', PostController::class);

            // CATEGORIES
            Route::get('categories', [CategoryController::class, 'index'])
                ->name('categories.index');

            Route::get('categories/create', [CategoryController::class, 'create'])
                ->name('categories.create');

            Route::post('categories', [CategoryController::class, 'store'])
                ->name('categories.store');

            Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])
                ->name('categories.edit');

            Route::put('categories/{id}', [CategoryController::class, 'update'])
                ->name('categories.update');

            Route::delete('categories/{id}', [CategoryController::class, 'destroy'])
                ->name('categories.destroy');
        });
    });

// FRONTEND
Route::get('/single', [App\Http\Controllers\IndexController::class, 'single'])->name('single');
Route::get('/contact', [App\Http\Controllers\IndexController::class, 'contact'])->name('home.contact');
Route::get('/home', [App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/news', [App\Http\Controllers\IndexController::class, 'news'])->name('home.news');
Route::get('/events', [App\Http\Controllers\IndexController::class, 'events'])->name('home.events');
Route::get('/plan', [App\Http\Controllers\IndexController::class, 'plan'])->name('home.plan');
Route::get('/explore', [App\Http\Controllers\IndexController::class, 'explore'])->name('home.explore');
Route::get('/post_details', [App\Http\Controllers\IndexController::class, 'post_details'])->name('home.post_details');