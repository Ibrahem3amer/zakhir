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

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::controller('users', 'UsersController');

Route::controller('pages', 'NavBarController');

Route::controller('media', 'MediaController');

Route::controller('product', 'ProductsController');

Route::controller('cart', 'CartController');

Route::controller('order', 'OrdersController');

