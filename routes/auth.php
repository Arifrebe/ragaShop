<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::prefix('auth')->name('auth.')->group(function () {

    // ================= REGISTER =================
    Route::get('/register', [RegisterController::class, 'show'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');


    // ================= LOGIN =================
    Route::get('/login', [LoginController::class, 'show'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])
        ->name('login.auth');


    // ================= LOGOUT =================
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

});