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

Auth::routes();
Route::get('articles/user/{id}','ArticlesController@userArticle');
Route::get('articles/manage','ArticlesController@manage');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('articles', 'ArticlesController');
Route::resource('users', 'UsersController');
Route::post('users/article/${id}', 'UsersController@storeArticle');
