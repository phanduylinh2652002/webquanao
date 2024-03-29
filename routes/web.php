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

Route::get('/', 'HomeController@index');

Route::get('/login', 'Auth\LoginController@index');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/register', 'Auth\RegisterController@index');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', 'admin\AdminController@index') ->name('dashboard');
    Route::resource('category', 'admin\CategoryController');
    Route::resource('product', 'admin\ProductController');
    Route::resource('size', 'admin\SizeController');
});
Route::get('/', 'PageController@getProduct');
