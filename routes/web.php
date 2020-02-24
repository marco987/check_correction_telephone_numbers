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

Route::get('/', 'TelephoneController@index')->name('home-page');

Route::post('/show', 'TelephoneController@show')->name('show');

Route::post('/verify_number', 'TelephoneController@verify_number')->name('verify_number');