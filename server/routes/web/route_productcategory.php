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
Route::get('/productcategories', 'ProductCategoriesController@index')->name('productcategories.index');
Route::get('/productcategories/create', 'ProductCategoriesController@create')->name('productcategories.create');
Route::post('/productcategories/create', 'ProductCategoriesController@store')->name('productcategories.store');
Route::get('/productcategories/{id}/edit', 'ProductCategoriesController@edit')->name('productcategories.edit');
Route::patch('/productcategories/{id}/update', 'ProductCategoriesController@update')->name('productcategories.update');
Route::delete('/productcategories/delete/{id}', 'ProductCategoriesController@destroy')->name('productcategories.destroy');
Route::get('/productcategories/{id}', 'ProductCategoriesController@show')->name('productcategories.show');
