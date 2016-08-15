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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']); //Home page, newest first
Route::get('last', ['as' => 'home.last', 'uses' => 'HomeController@home']); //Newest first
Route::get('old', ['as' => 'home.old', 'uses' => 'HomeController@homeOld']); //Oldest first
Route::get('popular/{since?}', ['as' => 'home.popular', 'uses' => 'HomeController@homePopular']); //Most viewed first
Route::get('obscure/{since?}', ['as' => 'home.obscure', 'uses' => 'HomeController@homeObscure']); //Less viewed first
Route::get('praised/{since?}', ['as' => 'home.praised', 'uses' => 'HomeController@homePraised']); //Highest up/down rate first
Route::get('vilified/{since?}', ['as' => 'home.vilified', 'uses' => 'HomeController@homeVilified']); //Lowest up/down rate first
Route::get('controversial/{since?}', ['as' => 'home.controversial', 'uses' => 'HomeController@homeControversial']); //Up/down rate closest to one first

Route::get('post/{post}', ['as' => 'post', 'uses' => 'PostController@post']); //Post page
Route::post('api/image', ['as' => 'api.image', 'uses' => 'PostController@uploadImage']);
Route::post('api/post', ['as' => 'api.post', 'uses' => 'PostController@newPost']);

Route::get('api/available/name', ['as' => 'api.available.name', 'uses' => 'AvailableController@nameIsAvailable']);
Route::get('api/available/email', ['as' => 'api.available.email', 'uses' => 'AvailableController@emailIsAvailable']);

Route::post('api/vote/up', ['as' => 'api.vote.up', 'uses' => 'VoteController@upVote']);
Route::post('api/vote/down', ['as' => 'api.vote.down', 'uses' => 'VoteController@downVote']);

Route::post('api/comment', ['as' => 'api.comment', 'uses' => 'CommentController@postComment']);

/*
 |--------------------------------------------------------------------------
 | SOCIAL LOGIN
 |--------------------------------------------------------------------------
 | To register new apps and obtain their ID/SECRET codes, visit their corresponding webs:
 | https://developers.facebook.com/apps
 | https://apps.twitter.com/app/new
 */
Route::get('auth/facebook', ['as' => 'facebook.provider', 'uses' => 'Auth\AuthController@redirectToFacebookProvider']);
Route::get('auth/facebook/callback', ['as' => 'facebook.callback', 'uses' => 'Auth\AuthController@handleFacebookProviderCallback']);
Route::get('auth/twitter', ['as' => 'twitter.provider', 'uses' => 'Auth\AuthController@redirectToTwitterProvider']);
Route::get('auth/twitter/callback', ['as' => 'twitter.callback', 'uses' => 'Auth\AuthController@handleTwitterProviderCallback']);
