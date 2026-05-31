<?php

use App\Http\Controllers\Dashboard\DashboardController;
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
        ->controller(DashboardController::class)
        ->middleware(['auth',LoginAdmin::class])->group(function (){
            Route::get('/','index')->name('Dashboard.َAdmin');
    });

    require_once __DIR__ . "/auth.php";

});

Route::fallback(function () {
    abort(404);
});
