<?php
//Route::get('/leads/create', 'LeadsController@create')->name('leads.create');
//Route::post('/leads/create', 'LeadsController@store')->name('leads.store');
//Route::get('/leads/{id}/edit', 'LeadsController@edit')->name('leads.edit');
//Route::patch('/leads/{id}/update', 'LeadsController@update')->name('leads.update');
//Route::delete('/leads/delete/{id}', 'LeadsController@destroy')->name('leads.destroy');
//Route::get('/leads/{id}', 'LeadsController@show')->name('leads.show');
Route::get('/messagetemplates/create', 'MessageTemplatesController@create')->name('messagetemplates.create');
Route::post('/messagetemplates/create', 'MessageTemplatesController@store')->name('messagetemplates.store');
Route::get('/messagetemplates/{id}/edit', 'MessageTemplatesController@edit')->name('messagetemplates.edit');
Route::patch('/messagetemplates/{id}/update', 'MessageTemplatesController@update')->name('messagetemplates.update');
Route::delete('/messagetemplates/delete/{id}', 'MessageTemplatesController@destroy')->name('messagetemplates.destroy');
Route::post('/messagetemplates/{id}/send-mail', 'MessageTemplatesController@sendMail')->name('messagetemplates.sendmail');
Route::get('/messagetemplates/{id}/showsendmessage', 'MessageTemplatesController@showSendMessage')->name('messagetemplates.showsendmessage');
Route::get('/messagetemplates/{id}', 'MessageTemplatesController@show')->name('messagetemplates.show');
Route::get('/messagetemplates', 'MessageTemplatesController@index')->name('messagetemplates.index');