<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LikeController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Main\CartController;
use App\Http\Controllers\Main\CheckOutController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\ReactionController;
use App\Http\Middleware\LoginAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('{lang}')->group(function (){

    Route::controller(HomeController::class)->group(function (){
        Route::get('/', 'index')->name('home');
        Route::post('logout', 'logout')->name('home.logout');
        Route::get('category/{category:name}', 'category')->name('home.category');
        Route::get('product/{product:slug}', 'product')->name('home.product');
        Route::post('comment/create', 'create_comment')->name('home.comment');
        Route::post('comment/reply', 'reply_comment')->name('home.reply');
        Route::get('user/profile', 'profile')->name('home.profile');
        Route::put('user/profile/update/{user:name}', 'profile_update')->name('home.profile.update');
    });
    Route::controller(ReactionController::class)->group(function (){
        Route::post('reaction/create', 'create_reaction')->name('reaction.create');
        Route::delete('reaction/delete', 'delete')->name('reaction.delete');
    });

    Route::controller(CartController::class)->group(function (){
        Route::post('cart/create', 'create')->name('cart.create');
        Route::get('cart/show', 'show')->name('cart.show');
        Route::delete('cart/delete', 'delete')->name('cart.delete');
        Route::put('cart/update/{cart}', 'update')->name('cart.update');
    });
    Route::controller(CheckOutController::class)->group(function (){
        Route::get('checkout', 'index')->name('checkout');
    });

    Route::prefix('Dashboard')
        ->middleware([LoginAdmin::class,'role:administrator|writer'])->group(function (){

            Route::controller(DashboardController::class)->group(function (){
                Route::get('/','index')->name('Dashboard.َAdmin');
                Route::post('logout','logout')->name('Dashboard.logout');

                Route::middleware('role:administrator')->group(function (){
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

            });

            Route::middleware(['role:administrator'])->controller(UserController::class)->group(function (){
                Route::get('users','users')->name('Dashboard.Users');
                Route::post('create-user','create')->name('Dashboard.AddUser');
                Route::delete('destroy/{user}','destroy')->name('Dashboard.DeleteUser');
                Route::get('edit-user/{user}','editForm')->name('Dashboard.EditForm');
                Route::put('update-user/{user}','update')->name('Dashboard.UpdateUser');
                Route::get('search-user','search')->name('Dashboard.SearchUser');
            });

            Route::controller(ProductController::class)->group(function (){
                Route::get('products','products')->name('Dashboard.Products');
                Route::post('create-product','create')->name('Dashboard.AddProduct');
                Route::delete('destroy-product/{product}','destroy')->name('Dashboard.DeleteProduct');
                Route::get('edit-pro/{product}','editForm')->name('Dashboard.EditFormProduct');
                Route::put('update-product/{product}','update')->name('Dashboard.UpdateProduct');
                Route::get('search-product','search')->name('Dashboard.SearchProduct');
                Route::post('product/state/{product}','state')->name('Dashboard.State');
            });

            Route::controller(CategoryController::class)->group(function (){
                Route::get('categories','categories')->name('Dashboard.categories');
                Route::post('create-category','create')->name('Dashboard.AddCategory');
                Route::delete('destroy-category/{category}','destroy')->name('Dashboard.DeleteCategory');
                Route::get('edit-cat/{category}','editForm')->name('Dashboard.EditFormCategory');
                Route::put('update-category/{category}','update')->name('Dashboard.UpdateCategory');
                Route::get('search-category','search')->name('Dashboard.SearchCategory');
            });

            Route::controller(CommentController::class)->group(function (){
                Route::get('comments','comments')->name('Dashboard.comments');
                Route::delete('delete-comment/{comment}','delete')->name('Dashboard.DeleteComments');
                Route::put('approve-comment/{comment}','approve_comment')->name('Dashboard.ApproveComments');
            });

            Route::controller(LikeController::class)->group(function (){
                Route::get('likes','likes')->name('Dashboard.likes');
                Route::delete('delete-like/{like}','delete_like')->name('Dashboard.DeleteLike');
            });

            Route::middleware(['role:administrator'])->controller(OrderController::class)->group(function (){
                Route::get('orders','orders')->name('Dashboard.orders');
                Route::put('orders/{order}','update')->name('Dashboard.OrdersUpdate');
            });

            Route::middleware(['role:administrator'])->controller(PermissionController::class)->group(function (){
                Route::get('permissions','permissions')->name('Dashboard.permissions');
                Route::post('permissions/create','create')->name('Dashboard.AddPermission');
                Route::delete('permission/destroy/{permission}','destroy')->name('Dashboard.DeletePermission');
                Route::get('permission/edit/{permission}','editForm')->name('Dashboard.EditPermission');
                Route::put('permission/update/{permission}','update')->name('Dashboard.UpdatePermission');
            });

            Route::middleware(['role:administrator'])->controller(RoleController::class)->group(function (){
                Route::get('roles','roles')->name('Dashboard.roles');
                Route::post('roles/create','create')->name('Dashboard.AddRole');
                Route::delete('roles/destroy/{role}','destroy')->name('Dashboard.DeleteRole');
                Route::get('roles/edit/{role}','editForm')->name('Dashboard.EditRole');
                Route::put('roles/update/{role}','update')->name('Dashboard.UpdateRole');
            });
    });

    require_once __DIR__ . "/auth.php";

});

Route::fallback(function () {
    abort(404);
});
