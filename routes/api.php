<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: content-type');

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [
	'as' => 'api.login', 
	'uses' => 'ApiController@login'
	]);

Route::post('/signup', [
	'as' => 'api.signup', 
	'uses' => 'ApiController@signup'
	]);

Route::post('/logout', [
	'as' => 'api.logout', 
	'uses' => 'ApiController@logout'
	]);

Route::post('/home', [
	'as' => 'api.home', 
	'uses' => 'ApiController@home'
	]);

Route::post('/check_medicine_information', [
	'as' => 'api.check_medicine_information', 
	'uses' => 'ApiController@check_medicine_information'
	]);

Route::post('/submit_report', [
	'as' => 'api.submit_report', 
	'uses' => 'ApiController@submit_report'
	]);

Route::post('/get_user', [
	'as' => 'api.get_user', 
	'uses' => 'ApiController@get_user'
	]);

Route::post('/make_appointment', [
	'as' => 'api.make_appointment', 
	'uses' => 'ApiController@make_appointment'
	]);

Route::post('/check_medicine_availability', [
	'as' => 'api.check_medicine_availability', 
	'uses' => 'ApiController@check_medicine_availability'
	]);

Route::post('/edit_profile', [
	'as' => 'api.edit_profile', 
	'uses' => 'ApiController@edit_profile'
	]);

Route::post('/upload_user_image', [
	'as' => 'api.upload_user_image', 
	'uses' => 'ApiController@upload_user_image'
	]);

Route::post('/upload_report_image', [
	'as' => 'api.upload_report_image', 
	'uses' => 'ApiController@upload_report_image'
	]);