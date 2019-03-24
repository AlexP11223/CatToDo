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

Route::get('/', 'TaskController@index');

Route::resource('todo', 'TaskController');
Route::get('todo/categories/{categoryName?}', 'TaskController@index')->name('category');
