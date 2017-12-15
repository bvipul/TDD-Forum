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

Route::get('/threads', 'ThreadsController@index')->name('threads.index');
Route::post('/threads', 'ThreadsController@store')->name('threads.store');
Route::get('/threads/create', 'ThreadsController@create')->name('threads.create');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show')->name('threads.show');
Route::get('/threads/{channel}', 'ThreadsController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::post('/replies/{reply}/favorite', 'FavoritesController@store')->name('reply.favorite');

Route::get('/profile/{user}', 'ProfilesController@show')->name('profile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
