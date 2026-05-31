<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {

    Route::get('/login', 'login')
        ->name('user.login')
        ->middleware('guest');

    Route::get('/register', 'register')
        ->name('user.register')
        ->middleware('guest');

    Route::post('/user_login', 'user_login')
        ->name('login-user');

    Route::post('/user_register', 'user_register')
        ->name('register-user');

});

Route::controller(PasswordController::class)->group(function () {

    Route::get('/reset-password', 'new_password')
        ->name('new-password');

    Route::post('/update-password', 'update_password')
        ->name('update-password-user');

    Route::get('/lastet-reset-password', 'lastet_reset_password')
        ->name('lastet-reset-password-user');

    Route::post('/update-new-password', 'update_pass')
        ->name('update-user');

});
