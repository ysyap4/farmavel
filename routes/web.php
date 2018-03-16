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




Route::get('manage_report_index',[
	'as' => 'manage_report_index',
	'uses' => 'ManageController@manage_report_index',
	]);

Route::get('manage_report_create', [
	'as' => 'manage_report_create',
	'uses' => 'ManageController@manage_report_create',
	]);

Route::post('manage_report_create_process', [
	'as' => 'manage_report_create_process',
	'uses' => 'ManageController@manage_report_create_process',
	]);

Route::get('manage_report_show',[
	'as' => 'manage_report_show',
	'uses' => 'ManageController@manage_report_show',
	]);

Route::get('manage_report_edit',[
	'as' => 'manage_report_edit',
	'uses' => 'ManageController@manage_report_edit',
	]);

Route::post('manage_report_edit_process',[
	'as' => 'manage_report_edit_process',
	'uses' => 'ManageController@manage_report_edit_process',
	]);

Route::get('manage_report_delete',[
	'as' => 'manage_report_delete',
	'uses' => 'ManageController@manage_report_delete',
	]);





Route::get('manage_appointment_index',[
	'as' => 'manage_appointment_index',
	'uses' => 'ManageController@manage_appointment_index',
	]);

Route::get('manage_appointment_create', [
	'as' => 'manage_appointment_create',
	'uses' => 'ManageController@manage_appointment_create',
	]);

Route::post('manage_appointment_create_process', [
	'as' => 'manage_appointment_create_process',
	'uses' => 'ManageController@manage_appointment_create_process',
	]);

Route::get('manage_appointment_show',[
	'as' => 'manage_appointment_show',
	'uses' => 'ManageController@manage_appointment_show',
	]);

Route::get('manage_appointment_edit',[
	'as' => 'manage_appointment_edit',
	'uses' => 'ManageController@manage_appointment_edit',
	]);

Route::post('manage_appointment_edit_process',[
	'as' => 'manage_appointment_edit_process',
	'uses' => 'ManageController@manage_appointment_edit_process',
	]);

Route::get('manage_appointment_delete',[
	'as' => 'manage_appointment_delete',
	'uses' => 'ManageController@manage_appointment_delete',
	]);




Route::get('manage_vas_index',[
	'as' => 'manage_vas_index',
	'uses' => 'ManageController@manage_vas_index',
	]);

Route::get('manage_vas_create', [
	'as' => 'manage_vas_create',
	'uses' => 'ManageController@manage_vas_create',
	]);

Route::post('manage_vas_create_process', [
	'as' => 'manage_vas_create_process',
	'uses' => 'ManageController@manage_vas_create_process',
	]);

Route::get('manage_vas_show',[
	'as' => 'manage_vas_show',
	'uses' => 'ManageController@manage_vas_show',
	]);

Route::get('manage_vas_edit',[
	'as' => 'manage_vas_edit',
	'uses' => 'ManageController@manage_vas_edit',
	]);

Route::post('manage_vas_edit_process',[
	'as' => 'manage_vas_edit_process',
	'uses' => 'ManageController@manage_vas_edit_process',
	]);

Route::get('manage_vas_delete',[
	'as' => 'manage_vas_delete',
	'uses' => 'ManageController@manage_vas_delete',
	]);




Route::get('graph_alltime_index',[
	'as' => 'graph_alltime_index',
	'uses' => 'GraphController@graph_alltime_index',
	]);

Route::get('graph_periodic_index',[
	'as' => 'graph_periodic_index',
	'uses' => 'GraphController@graph_periodic_index',
	]);

Route::get('graph_alltime_index_pdf',[
	'as' => 'graph_alltime_index_pdf',
	'uses' => 'GraphController@graph_alltime_index_pdf',
	]);

Route::post('graph_periodic_results', [
	'as' => 'graph_periodic_results',
	'uses' => 'GraphController@graph_periodic_results',
	]);