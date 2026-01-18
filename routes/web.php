<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;

Route::get('/', function () {
    $postImages = \App\Models\PostImage::with('post')->get();
    return view('ui-index.index', compact('postImages'));
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

        Route::resource('post-images', \App\Http\Controllers\PostImageController::class);

        //category
        Route::get('categories', [CategoryController::class, 'index'])->name('category.list');

        Route::get('categories/create', [CategoryController::class, 'create'])->name('category.create');

        Route::post('categories', [CategoryController::class, 'store'])->name('category.store');

        Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');

        Route::put('categories/{id}', [CategoryController::class, 'update'])->name('category.update');

        Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});
Route::get('/archive', [App\Http\Controllers\IndexController::class, 'archive'])->name('archive')->middleware('track.visitor');

Route::middleware('track.visitor')->group(function () {

    Route::get('/bai-viet/{slug}', [FrontendPostController::class, 'show'])
        ->name('posts.show');

});

