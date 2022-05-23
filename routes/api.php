<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthController@login')->name('login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logout');
    });

});

Route::apiResource('products', 'ProductController')->except(['update', 'store', 'destroy']);
Route::apiResource('carts', 'CartController')->except(['update', 'index']);
Route::apiResource('orders', 'OrderController')->except(['update', 'destroy','store'])->middleware('auth:api');
Route::post('/carts/{cart}', 'CartController@addProducts');
Route::post('/carts/{cart}/checkout', 'CartController@checkout');