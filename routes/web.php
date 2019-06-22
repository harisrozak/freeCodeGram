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


Auth::routes();

// temporary email view
Route::get('/email-welcome-template', function(){
	return new \App\Mail\NewUserWelcomeMail();
});

// follows routes
Route::post('/follow/{user}', 'FollowsController@create')->name('follow.create');

// posts routes
Route::get('/', 'PostsController@index')->name('p.index');
Route::get('/p/create', 'PostsController@create')->name('p.create');
Route::post('/p', 'PostsController@store')->name('p.store');
Route::get('/p/show/{post}', 'PostsController@show')->name('p.show');

// profiles routes
Route::get('/profiles', 'ProfilesController@index')->name('profiles.index');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles.show');
Route::get('/profiles/{user}/edit', 'ProfilesController@edit')->name('profiles.edit');
Route::patch('/profiles/{user}', 'ProfilesController@update')->name('profiles.update');
