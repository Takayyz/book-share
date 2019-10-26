<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/misawa', 'IndexController@show');
    Route::post('/misawa/generate','GeneratorController@execute');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('auth/login', 'Auth\SocialController@viewLogin');
Route::get('auth/facebook', 'Auth\SocialController@redirectToFacebookProvider');
Route::get('auth/facebook/callback', 'Auth\SocialController@handleFacebookProviderCallback');