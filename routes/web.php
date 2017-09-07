<?php

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

Route::get('/', 'StaticPagesController@index');
Route::get('/contacts', 'StaticPagesController@contacts');

Route::resource('/products', 'ProductsController');

Auth::routes();

Route::get('/user', 'UserController@index')->name('home');
Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::resource('products', 'ProductsController');
});
