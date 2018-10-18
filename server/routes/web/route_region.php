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
Route::get('/regions', 'RegionsController@index')->name('regions.index');
Route::get('/regions/create', 'RegionsController@create')->name('regions.create');
Route::post('/regions/create', 'RegionsController@store')->name('regions.store');
Route::get('/regions/{id}/edit', 'RegionsController@edit')->name('regions.edit');
Route::patch('/regions/{id}/update', 'RegionsController@update')->name('regions.update');
Route::delete('/regions/delete/{id}', 'RegionsController@destroy')->name('regions.destroy');
Route::get('/regions/{id}', 'RegionsController@show')->name('regions.show');
