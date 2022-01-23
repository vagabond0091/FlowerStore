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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/Product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('/Order', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
// Route::post('/register','\App\Http\Controllers\Auth\RegisterController@userCreate');