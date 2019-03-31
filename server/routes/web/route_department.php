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
Route::get('/departments', 'DepartmentController@index')->name('departments.index');
Route::get('/departments/create', 'DepartmentController@create')->name('departments.create');
Route::post('/departments/create', 'DepartmentController@store')->name('departments.store');
Route::get('/departments/{id}/edit', 'DepartmentController@edit')->name('departments.edit');
Route::patch('/departments/{id}/update', 'DepartmentController@update')->name('departments.update');
Route::delete('/departments/delete/{id}', 'DepartmentController@destroy')->name('departments.destroy');
Route::get('/departments/{id}', 'DepartmentController@show')->name('departments.show');
