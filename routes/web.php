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


Route::get('/login', [\App\Http\Controllers\Backend\LoginController::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\Backend\LoginController::class, 'login']);



Route::middleware('auth')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\Backend\LoginController::class, 'logout'])->name('logout');

    Route::middleware('isAdmin')->prefix('dashboard')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
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


