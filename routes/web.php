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

Auth::routes(['reset' => false]);

Route::get('/', 'TaskController@index');

Route::resource('tasks', 'TaskController');
Route::get('tasks/categories/{categoryName?}', 'TaskController@index')->name('category');
Route::put('tasks/{task}/completed', 'TaskController@toggle')->name('task_toggle');

Route::get('cats/random', 'CatController@random')->name('random_cat');
