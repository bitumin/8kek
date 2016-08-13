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

Route::get('/', ['as' => 'home', 'uses' => 'MainController@home']); //Newest first
Route::get('/last', ['as' => 'home.last', 'uses' => 'MainController@home']); //Newest first
Route::get('/old', ['as' => 'home.old', 'uses' => 'MainController@homeOld']); //Oldest first
Route::get('/popular/{since?}', ['as' => 'home.popular', 'uses' => 'MainController@homePopular']); //Most viewed first
Route::get('/obscure/{since?}', ['as' => 'home.obscure', 'uses' => 'MainController@homeObscure']); //Less viewed first
Route::get('/praised/{since?}', ['as' => 'home.praised', 'uses' => 'MainController@homePraised']); //Highest up/down rate first
Route::get('/vilified/{since?}', ['as' => 'home.vilified', 'uses' => 'MainController@homeVilified']); //Lowest up/down rate first
Route::get('/controversial/{since?}', ['as' => 'home.controversial', 'uses' => 'MainController@homeControversial']); //Most voted + up/down rate closest to one first

Route::get('post/{post}', ['as' => 'post', 'uses' => 'MainController@post']);

Route::get('services/available/name', ['as' => 'services.available.name', 'uses' => 'MainController@nameIsAvailable']);
Route::get('services/available/email', ['as' => 'services.available.email', 'uses' => 'MainController@emailIsAvailable']);

Route::post('services/upload/image', ['as' => 'services.upload.image', 'uses' => 'MainController@postImageUpload']);
Route::post('services/upload/post', ['as' => 'services.upload.post', 'uses' => 'MainController@postUpload']);

Route::post('services/vote/up', ['as' => 'services.vote.up', 'uses' => 'MainController@upVote']);
Route::post('services/vote/down', ['as' => 'services.vote.down', 'uses' => 'MainController@downVote']);

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
