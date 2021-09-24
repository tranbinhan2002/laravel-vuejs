<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::namespace('App\Http\Controllers')->group(function(){
    Route::post('admin-login','AuthController@login');
    Route::post('admin-register','AuthController@register');
    Route::post('admin-logout','AuthController@logout');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::namespace('App\Http\Controllers\Admin')->group(function(){
        //user
        Route::resource('user', UserController::class);
        Route::put('user/change-password/{user}','UserController@changePassword');
        Route::put('change-status-user/{user}','UserController@changeStatus');
         //profile
         Route::get('profile','ProfileController@index');
         Route::put('profile/{profile}', 'ProfileController@update');
         Route::put('profile/change-password/{user}','ProfileController@changePassword');
        //category
        Route::resource('category', CategoryController::class);
        Route::put('change-status-category/{category}','CategoryController@changeStatus');
         //product
         Route::resource('product', ProductController::class);
         Route::put('change-status-product/{product}','ProductController@changeStatus');
    });
});

//Frontend
Route::namespace('App\Http\Controllers\Frontend')->group(function(){
    //Auth
    Route::post('login','AuthController@login');
    Route::post('register','AuthController@register');
    Route::post('logout','AuthController@logout');
    
    Route::get('fresh-category','CategoryController@index');
    Route::get('fresh-product','ProductController@index');
    Route::get('filter-product/{id}','ProductController@productFilter');


    Route::post('order', 'OrderController@order');
    Route::get('receipt', 'OrderController@index');
});