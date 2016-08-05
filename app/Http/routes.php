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
});

Route::get('auth/twitter', 'Auth\AuthController@redirectToTwitterProvider');
Route::get('auth/twitter/callback', 'Auth\AuthController@handleTwitterProviderCallback');
Route::get('auth/facebook', 'Auth\AuthController@redirectToFacebookProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleFacebookProviderCallback');

Route::auth();

Route::get('/home', 'HomeController@index');
