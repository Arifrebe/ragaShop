<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\ContactUsController;

// Routing Halaman Depan (Pengunjung)
Route::name('front.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/products', [ShopController::class, 'index'])->name('products');
    Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
    Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/contact', [ContactUsController::class, 'index'])->name('contact');

    Route::post('/process-checkout', [ShopController::class, 'processCheckout']);
    Route::post('/callback', [ShopController::class, 'callback']);
});