<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::prefix('auth')->name('auth.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Guest Routes (Belum login)
    |--------------------------------------------------------------------------
    */
    Route::middleware('guest')->group(function () {

        // Register
        Route::controller(RegisterController::class)->group(function () {
            Route::get('/register', 'show')->name('register');
            Route::post('/register', 'store')->name('register.store');
        });

        // Login
        Route::controller(LoginController::class)->group(function () {
            Route::get('/login', 'show')->name('login');
            Route::post('/login', 'authenticate')->name('login.store');
        });

    });

    /*
    |--------------------------------------------------------------------------
    | Authenticated Routes (Sudah login)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {

        Route::post('/logout', [LoginController::class, 'logout'])
            ->name('logout');

    });

});