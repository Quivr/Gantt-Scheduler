<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'taskController@index');

Auth::routes();

Route::resource('tasks', 'taskController');
Route::resource('users', 'UserController');
Route::resource('resources', 'resourceController');

Route::get('/home', 'HomeController@index');

Route::get('/data/tasks', 'taskController@indexData')->name('tasks.data');


Route::get('/test', function(){
	return view('test');
})->name('chart');
