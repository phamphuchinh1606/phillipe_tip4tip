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
Route::get('/assignments', 'AssignmentsController@index')->name('assignments.index');
Route::get('/assignments/create', 'AssignmentsController@create')->name('assignments.create');
Route::post('/assignments/create', 'AssignmentsController@store')->name('assignments.store');
Route::get('/assignments/{id}/edit', 'AssignmentsController@edit')->name('assignments.edit');
Route::patch('/assignments/{id}/update', 'AssignmentsController@update')->name('assignments.update');
Route::delete('/assignments/delete/{id}', 'AssignmentsController@destroy')->name('assignments.destroy');
Route::get('/assignments/{id}', 'AssignmentsController@show')->name('assignments.show');