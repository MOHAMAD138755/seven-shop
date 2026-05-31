<?php

use Illuminate\Support\Facades\Route;

Route::prefix('{lang}')->group(function (){

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
    });

    require_once __DIR__ . "/auth.php";

});

Route::fallback(function () {
    abort(404);
});
