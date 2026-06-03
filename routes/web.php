<?php

use App\Http\Controllers\Dashboard\CategoryController;
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
                Route::post('create-user','create')->name('Dashboard.AddUser');
                Route::delete('destroy/{user}','destroy')->name('Dashboard.DeleteUser');
                Route::get('edit-form/{user}','editForm')->name('Dashboard.EditForm');
                Route::put('update/{user}','update')->name('Dashboard.UpdateUser');
            });

            Route::controller(ProductController::class)->group(function (){
                Route::get('products','products')->name('Dashboard.Products');
                Route::post('create-product','create')->name('Dashboard.AddProduct');
                Route::delete('destroy/{product}','destroy')->name('Dashboard.DeleteProduct');
                Route::get('edit-form/{product}','editForm')->name('Dashboard.EditFormProduct');
                Route::put('update/{product}','update')->name('Dashboard.UpdateProduct');
            });

            Route::controller(CategoryController::class)->group(function (){
                Route::get('categories','categories')->name('Dashboard.categories');
                Route::post('create-category','create')->name('Dashboard.AddCategory');
                Route::delete('destroy/{category}','destroy')->name('Dashboard.DeleteCategory');
                Route::get('edit-form/{category}','editForm')->name('Dashboard.EditFormCategory');
                Route::put('update/{category}','update')->name('Dashboard.UpdateCategory');
            });
    });

    require_once __DIR__ . "/auth.php";

});

Route::fallback(function () {
    abort(404);
});
