<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::namespace('App\Http\Controllers')->group(function(){
    Route::post('login','AuthController@login');
    Route::post('register','AuthController@register');
    Route::post('logout','AuthController@logout');
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
    });
});