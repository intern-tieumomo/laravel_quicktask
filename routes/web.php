<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('locale')->group(function () {
	Route::get('change-language/{lang}', 'MyController@changeLanguage')->name('change-language');
	Route::get('/', 'MyController@home');

	Route::resource('tasks', 'TaskController')->only([
	    'index', 'store', 'destroy'
	]);

	Route::resource('employees', 'EmployeeController')->only([
	    'index', 'store', 'destroy'
	]);
});
