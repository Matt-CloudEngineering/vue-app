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

Route::get('projects/create','ProjectsController@create');
Route::get('projects','ProjectsController@store');


Route::get('/', function () {
    return view('welcome');
});

Route::get('skills', function() {
	return ['Laravel','Vue','PHP','Javascript','Tooling'];
});

Route::get('/phpinfo', function () {
	return view('phpinfo');
});