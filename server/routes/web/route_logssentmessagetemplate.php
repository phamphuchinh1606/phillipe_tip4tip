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
Route::get('/logssentmessagetemplates', 'LogsSentMessageTemplatesController@index')->name('logsentmessages.index');
Route::get('/logssentmessagetemplates/create', 'LogsSentMessageTemplatesController@create')->name('logsentmessages.create');
Route::post('/logssentmessagetemplates/create', 'LogsSentMessageTemplatesController@store')->name('logsentmessages.store');
Route::get('/logssentmessagetemplates/{id}/edit', 'LogsSentMessageTemplatesController@edit')->name('logsentmessages.edit');
Route::patch('/logssentmessagetemplates/{id}/update', 'LogsSentMessageTemplatesController@update')->name('logsentmessages.update');
Route::delete('/logssentmessagetemplates/delete/{id}', 'LogsSentMessageTemplatesController@destroy')->name('logsentmessages.destroy');
Route::get('/logssentmessagetemplates/{id}', 'LogsSentMessageTemplatesController@show')->name('logsentmessages.show');