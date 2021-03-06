<?php

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

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::group(['middleware' => 'auth:api'], function () {
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show');
    Route::get('user', 'UserController@info');
    Route::get('merchandise', 'ProductController@merchandise');
    Route::get('products', 'ProductController@index');
    Route::post('serial', 'ShopController@getSerialNumber');
    Route::get('downline', 'UserController@getDownline');
    Route::post('checkout', 'ShopController@checkout');
    Route::get('orders', 'OrderController@index');
    Route::get('orders/{order}', 'OrderController@show');
    Route::get('buyer-orders', 'OrderController@buyerIndex');

});