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

Route::get('/', function()
{
    return view('index');
});
Route::get('/more', function()
{
    return view('more.index');
});
Route::resource('bars', 'BarsController');
Route::resource('users', 'UserController');
Route::resource('events', 'EventsController');
Route::resource('specials', 'SpecialsController');
Route::resource('reviews', 'ReviewsController');
Route::resource('votes', 'VotesController');

Route::post('picture/upload/{bar_id}', 'PicturesController@store');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/nearby/{latitude}/{longitude}', 'BarsController@nearby');
Route::get('/search', 'BarsController@search');
Route::get('/recent', 'BarsController@recent');

Route::post('votes/create', 'VotesController@vote');
