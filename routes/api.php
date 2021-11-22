<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('products',[\App\Http\Controllers\Api\ProductController::class,'index']);
Route::get('products/show/{id}',[\App\Http\Controllers\Api\ProductController::class,'show']);

Route::post('products/store',[\App\Http\Controllers\Api\ProductController::class,'store']);
Route::post('products/update/{id}',[\App\Http\Controllers\Api\ProductController::class,'update']);
Route::get('products/delete/{id}',[\App\Http\Controllers\Api\ProductController::class,'delete']);
