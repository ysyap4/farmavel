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

Route::post('manage_user_create_process', [
	'as' => 'manage_user_create_process',
	'uses' => 'ManageController@manage_user_create_process',
	]);

Route::get('manage_user_show',[
	'as' => 'manage_user_show',
	'uses' => 'ManageController@manage_user_show',
	]);

Route::get('manage_user_edit',[
	'as' => 'manage_user_edit',
	'uses' => 'ManageController@manage_user_edit',
	]);

Route::post('manage_user_edit_process',[
	'as' => 'manage_user_edit_process',
	'uses' => 'ManageController@manage_user_edit_process',
	]);

Route::get('manage_user_delete',[
	'as' => 'manage_user_delete',
	'uses' => 'ManageController@manage_user_delete',
	]);




Route::get('manage_medicine_index',[
	'as' => 'manage_medicine_index',
	'uses' => 'ManageController@manage_medicine_index',
	]);

Route::get('manage_medicine_create', [
	'as' => 'manage_medicine_create',
	'uses' => 'ManageController@manage_medicine_create',
	]);

Route::post('manage_medicine_create_process', [
	'as' => 'manage_medicine_create_process',
	'uses' => 'ManageController@manage_medicine_create_process',
	]);

Route::get('manage_medicine_show',[
	'as' => 'manage_medicine_show',
	'uses' => 'ManageController@manage_medicine_show',
	]);

Route::get('manage_medicine_edit',[
	'as' => 'manage_medicine_edit',
	'uses' => 'ManageController@manage_medicine_edit',
	]);

Route::post('manage_medicine_edit_process',[
	'as' => 'manage_medicine_edit_process',
	'uses' => 'ManageController@manage_medicine_edit_process',
	]);

Route::get('manage_medicine_delete',[
	'as' => 'manage_medicine_delete',
	'uses' => 'ManageController@manage_medicine_delete',
	]);