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


Route::get('/', function(){
	return view('chart');
})->name('chart');

Auth::routes();

Route::resource('weekreports', 'WeekreportController');
Route::resource('tasks', 'taskController');
Route::resource('users', 'UserController');
Route::resource('resources', 'resourceController');
Route::resource('departments', 'departmentController');

Route::post('tasks/{id}/dependency', 'taskController@createDependency')->name('tasks.createDependency');
Route::delete('dependencies/{id1}/{id2}', 'taskController@destroyDependency')->name('tasks.deleteDependency');

Route::get('/home', 'HomeController@index');

Route::get('/data/tasks', 'taskController@indexData')->name('tasks.data');

