<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[\App\Http\Controllers\Frontend\FrontendController::class,'index'])->name('home');

Route::get('add/cart/{id}',[\App\Http\Controllers\Frontend\CartController::class,'addCart'])->name('add.cart');
Route::get('cart/',[\App\Http\Controllers\Frontend\CartController::class,'show'])->name('show.cart');



Route::get('/login', [\App\Http\Controllers\Backend\LoginController::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\Backend\LoginController::class, 'login']);

Route::get('register',[\App\Http\Controllers\Frontend\UserController::class,'register'])->name('register');
Route::post('register',[\App\Http\Controllers\Frontend\UserController::class,'doRegister']);



Route::middleware('auth')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\Backend\LoginController::class, 'logout'])->name('logout');

    Route::get('profile',[\App\Http\Controllers\Frontend\UserController::class,'profile'])->name('profile');
    Route::post('profile',[\App\Http\Controllers\Frontend\UserController::class,'updateProfile']);

    Route::get('profile/{id}/order',[\App\Http\Controllers\Frontend\UserController::class,'order'])->name('profile.order');


    Route::get('checkout',[\App\Http\Controllers\Frontend\CartController::class,'checkout'])->name('checkout');
    Route::post('checkout',[\App\Http\Controllers\Frontend\CartController::class,'order']);


    Route::middleware('isAdmin')->prefix('dashboard')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

        //admin order
        Route::get('order',[\App\Http\Controllers\Backend\OrderController::class,'index'])->name('admin.order');
        Route::get('order/{id}',[\App\Http\Controllers\Backend\OrderController::class,'show'])->name('admin.order.show');
        Route::post('order/{id}/status',[\App\Http\Controllers\Backend\OrderController::class,'update'])->name('admin.order.update');

        //Products
        Route::prefix('products')->group(function (){
            Route::get('/', [\App\Http\Controllers\Backend\ProductController::class, 'index'])->name('admin.product');
            Route::get('/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])->name('admin.product.create');
            Route::post('/create', [\App\Http\Controllers\Backend\ProductController::class, 'store']);
            Route::get('/{id}/edit', [\App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('admin.product.edit');
            Route::post('/{id}/edit', [\App\Http\Controllers\Backend\ProductController::class, 'update']);
            Route::get('/{id}/delete', [\App\Http\Controllers\Backend\ProductController::class, 'delete'])->name('admin.product.delete');
        });
    });
});


