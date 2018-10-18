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
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users/create', 'UsersController@store')->name('users.store');
Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{id}/update', 'UsersController@update')->name('users.update');
Route::delete('/users/delete/{id}', 'UsersController@destroy')->name('users.destroy');
Route::get('/users/{id}', 'UsersController@show')->name('users.show');
