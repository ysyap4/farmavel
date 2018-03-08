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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('manage_user_index',[
	'as' => 'manage_user_index',
	'uses' => 'ManageController@manage_user_index',
	]);

Route::get('manage_user_create', [
	'as' => 'manage_user_create',
	'uses' => 'ManageController@manage_user_create',
	]);

