<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Auth Admin
Route::get('admin/login', 'AdminController@login');
Route::post('admin/login', 'AdminController@plogin');

//Page navigation
Route::get('page/{id}', 'PagesController@grabPage');

Route::group(['middleware' => ['auth']], function () {
    Route::controller('cart', 'CartController');
	Route::controller('order', 'OrdersController');
	Route::controller('admin', 'AdminController');
});

Route::controller('media', 'MediaController');

Route::controller('product', 'ProductsController');

Route::get('/', function () {return view('welcome');})->name('home');

Route::controller('users', 'UsersController');

Route::controller('pages', 'NavBarController');


