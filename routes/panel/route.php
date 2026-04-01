<?php

use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\PromoController;
use App\Http\Controllers\Panel\OrderController;

Route::get('/', function () {
    return view('panel.dashboard');
})->name('dashboard');

Route::prefix('product')->name('product.')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::get('/edit/{slug}', [ProductController::class, 'edit'])->name('edit');
    Route::get('/show/{slug}', [ProductController::class, 'show'])->name('show');

    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::put('/update/{slug}', [ProductController::class, 'update'])->name('update');
    Route::delete('/destroy/{slug}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::prefix('category')->name('category.')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::get('/edit/{slug}', [CategoryController::class, 'edit'])->name('edit');
    Route::get('/show/{slug}', [CategoryController::class, 'show'])->name('show');

    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::put('/update/{slug}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/destroy/{slug}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::prefix('promo')->name('promo.')->group(function() {
    Route::get('/', [PromoController::class, 'index'])->name('index');
    Route::get('/create', [PromoController::class, 'create'])->name('create');
    Route::get('/edit/{code}', [PromoController::class, 'edit'])->name('edit');
    Route::get('/show/{code}', [PromoController::class, 'show'])->name('show');

    Route::post('/store', [PromoController::class, 'store'])->name('store');
    Route::put('/update/{code}', [PromoController::class, 'update'])->name('update');
    Route::delete('/destroy/{code}', [PromoController::class, 'destroy'])->name('destroy');
});

Route::prefix('order')->name('order.')->group(function() {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/create', [OrderController::class, 'create'])->name('create');
    Route::get('/edit/{code}', [OrderController::class, 'edit'])->name('edit');
    Route::get('/show/{code}', [OrderController::class, 'show'])->name('show');

    Route::post('/store', [OrderController::class, 'store'])->name('store');
    Route::put('/update/{code}', [OrderController::class, 'update'])->name('update');
    Route::delete('/destroy/{code}', [OrderController::class, 'destroy'])->name('destroy');
});