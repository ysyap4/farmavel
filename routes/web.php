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

Route::get('manage_user',[
	'as' => 'manage_user',
	'uses' => 'ManageController@manage_user',
	]);

// Route::post('manage_user_edit/{$x}',[
// 	'as' => 'manage_user_edit',
// 	'uses' => 'ManageController@manage_user_edit',
// 	]);