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

Route::auth();
Route::get('/', ['as' => 'home', 'uses' => 'MainController@home']);
Route::get('post/{post}', ['as' => 'post', 'uses' => 'MainController@post']);
Route::get('services/available/name', ['as' => 'services.available.name', 'uses' => 'MainController@nameIsAvailable']);
Route::get('services/available/email', ['as' => 'services.available.email', 'uses' => 'MainController@emailIsAvailable']);

/*
 |--------------------------------------------------------------------------
 | SOCIAL LOGIN
 |--------------------------------------------------------------------------
 |
 | Don't forget to fill the apps ID and SECRET fields in .env.
 | To register new apps and obtain their ID/SECRET codes, visit their corresponding webs:
 | https://developers.facebook.com/apps
 | https://apps.twitter.com/app/new
 */
Route::get('auth/facebook', ['as' => 'facebook.provider', 'uses' => 'Auth\AuthController@redirectToFacebookProvider']);
Route::get('auth/facebook/callback', ['as' => 'facebook.callback', 'uses' => 'Auth\AuthController@handleFacebookProviderCallback']);
Route::get('auth/twitter', ['as' => 'twitter.provider', 'uses' => 'Auth\AuthController@redirectToTwitterProvider']);
Route::get('auth/twitter/callback', ['as' => 'twitter.callback', 'uses' => 'Auth\AuthController@handleTwitterProviderCallback']);
