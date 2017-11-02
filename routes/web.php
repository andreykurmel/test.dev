<?php
use Illuminate\Http\Request;
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

Route::get('/', 'StaticPagesController@index')->name('root');
Route::get('/contacts', 'StaticPagesController@contacts');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('/products', 'ProductsController')->except(['index', 'show']);

    Route::get('/user', 'UserController@index')->name('home')->middleware('test');
    Route::get('/user/ajax-search', 'UserController@ajaxSearch')->name('user.ajax-search');
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::resource('products', 'ProductsController');
    });
    Route::get('/orders/create', 'OrdersController@create')->name('orders.create');
    Route::post('/orders', 'OrdersController@store')->name('orders.store');
});

Route::resource('/products', 'ProductsController')->only(['index', 'show']);
