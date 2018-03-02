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

Route::get('app/{name}', function($name) {
  return redirect('/public/app/' . $name);
})->where('name', '[A-Za-z0-9\/\.\-]+');

Route::get('assets/{name}', function($name) {
  return redirect('/public/assets/' . $name);
})->where('name', '[A-Za-z0-9\/\.\-]+');
