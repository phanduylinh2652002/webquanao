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
    return view('frontend/index');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', 'admin\AdminController@index');
    Route::resource('category', 'admin\CategoryController');
    Route::resource('product', 'admin\ProductController');
    Route::resource('size', 'admin\SizeController');
});
