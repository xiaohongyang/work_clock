<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::group(['middleware' => 'web'], function(){

    Route::get('/', [
        'uses' => 'PublicController@home',
        'as' => '/'
    ]);
    Route::get('/login', [
        'uses' => 'PublicController@login',
        'as' => 'login'
    ]);
    Route::get('/register', [
        'uses' => 'PublicController@register',
        'as' => 'register'
    ]);
    Route::post('/doRegister', [
        'uses' => 'PublicController@doRegister',
        'as' => 'doRegister'
    ]);
    Route::get('/logout', [
        'uses' => 'PublicController@logout',
        'as' => 'logout'
    ]);
    Route::post('/doSignOn', [
        'uses' => 'PublicController@doSignOn',
        'as' => 'doSignOn'
    ]);


    Route::group(['middleware' => 'auth'], function(){
        Route::get('/dashboard', [
            'uses' => 'WorkClockController@dashboard',
            'as' => 'dashboard'
        ]);

        Route::get('/userList', [
            'uses' => 'UserController@userList',
            'as' => 'userList'
        ]);
    });


});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
