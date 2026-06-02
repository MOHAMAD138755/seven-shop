<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Middleware\LoginAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('{lang}')->group(function (){

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
    });

    Route::prefix('Dashboard')
        ->middleware(['auth',LoginAdmin::class])->group(function (){

            Route::controller(DashboardController::class)->group(function (){
                Route::get('/','index')->name('Dashboard.َAdmin');
            });

            Route::controller(UserController::class)->group(function (){
                Route::get('users','users')->name('Dashboard.Users');
            });


            Route::controller(ProductController::class)->group(function (){
                Route::get('products','products')->name('Dashboard.Products');
            });
    });

    require_once __DIR__ . "/auth.php";

});

Route::fallback(function () {
    abort(404);
});
