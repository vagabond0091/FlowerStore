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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/uploadImage', [App\Http\Controllers\ProductController::class, 'imageUpload']);
Route::post('/createProduct', [App\Http\Controllers\ProductController::class, 'store']);
Route::put('/updateProduct/{id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::get('/getAllProductsByUser/{id}', [App\Http\Controllers\ProductController::class, 'getAllProductsByUser']);
Route::get('/getAllProducts', [App\Http\Controllers\ProductController::class, 'getAllProducts']);
Route::delete('/deleteProduct/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);

Route::post('/createOrder', [App\Http\Controllers\OrderController::class, 'store']);

Route::get('/getAllOrdersbyUser/{id}', [App\Http\Controllers\OrderController::class, 'getAllOrdersbyUser']);
