<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Middleware\LoginAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('{lang}')->group(function (){

    Route::get('/', function () {
        return view('welcome');
    });

    Route::prefix('Dashboard')
        ->middleware(['auth',LoginAdmin::class])->group(function (){

            Route::controller(DashboardController::class)->group(function (){
                Route::get('/','index')->name('Dashboard.َAdmin');
                Route::post('logout','logout')->name('Dashboard.logout');
                Route::get('config','config')->name('Dashboard.config');
                Route::post('update-config','update_config')->name('Dashboard.update-config');
                Route::get('general','general')->name('Dashboard.general');
                Route::get('info','info')->name('Dashboard.info');
                Route::get('email','email')->name('Dashboard.email');
                Route::post('email/test','email_test')->name('Dashboard.email-test');
                Route::get('maintenance','maintenance')->name('Dashboard.maintenance');
                Route::get('security','security')->name('Dashboard.security');
                Route::post('update-password','update_password')->name('Dashboard.update-password');
            });

            Route::controller(UserController::class)->group(function (){
                Route::get('users','users')->name('Dashboard.Users');
                Route::post('create-user','create')->name('Dashboard.AddUser');
                Route::delete('destroy/{user}','destroy')->name('Dashboard.DeleteUser');
                Route::get('edit-user/{user}','editForm')->name('Dashboard.EditForm');
                Route::put('update-user/{user}','update')->name('Dashboard.UpdateUser');
            });

            Route::controller(ProductController::class)->group(function (){
                Route::get('products','products')->name('Dashboard.Products');
                Route::post('create-product','create')->name('Dashboard.AddProduct');
                Route::delete('destroy-product/{product}','destroy')->name('Dashboard.DeleteProduct');
                Route::get('edit-pro/{product}','editForm')->name('Dashboard.EditFormProduct');
                Route::put('update-product/{product}','update')->name('Dashboard.UpdateProduct');
            });

            Route::controller(CategoryController::class)->group(function (){
                Route::get('categories','categories')->name('Dashboard.categories');
                Route::post('create-category','create')->name('Dashboard.AddCategory');
                Route::delete('destroy-category/{category}','destroy')->name('Dashboard.DeleteCategory');
                Route::get('edit-cat/{category}','editForm')->name('Dashboard.EditFormCategory');
                Route::put('update-category/{category}','update')->name('Dashboard.UpdateCategory');
            });

            Route::controller(CommentController::class)->group(function (){
                Route::get('comments','comments')->name('Dashboard.comments');
            });
    });

    require_once __DIR__ . "/auth.php";

});

Route::fallback(function () {
    abort(404);
});
