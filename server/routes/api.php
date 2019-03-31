<?php

use Illuminate\Http\Request;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*========================
 * API for TIPSTER
 *======================== */
Route::get('/tipsters', 'Api\TipstersAPIController@index');
Route::get('/tipsters/{id}', 'Api\TipstersAPIController@show');
Route::post('/tipsters/', 'Api\TipstersAPIController@store');
Route::patch('/tipsters/{id}', 'Api\TipstersAPIController@update');
Route::delete('/tipsters/{id}', 'Api\TipstersAPIController@destroy');
/*========================
 * API for LEAD
 *======================== */
Route::get('/leads', 'Api\LeadsAPIController@index');
Route::get('/leads/add/{id}', 'Api\LeadsAPIController@add');
Route::post('/leads/add', 'Api\LeadsAPIController@store');
Route::get('/leads/edit/{tipsterId}/{leadId}', 'Api\LeadsAPIController@edit');
Route::post('/leads/edit', 'Api\LeadsAPIController@update');
Route::get('/leadsbytipster/{id}', 'Api\LeadsAPIController@leadsByTipster');
Route::get('/leads/{id}', 'Api\LeadsAPIController@show');
Route::post('/leads/delete/{id}', 'Api\LeadsAPIController@delete');
/*========================
 * API for GIFT
 *======================== */
Route::get('/gifts', 'Api\GiftsAPIController@index');
Route::get('/gifts/{id}', 'Api\GiftsAPIController@show');
Route::get('/gifts-list/{tipsterId}','Api\GiftsAPIController@listGift');
//Route::post('/gifts/', 'Api\GiftsAPIController@store');
//Route::patch('/gifts/{id}', 'Api\GiftsAPIController@update');
//Route::delete('/gifts/{id}', 'Api\GiftsAPIController@destroy');

/*========================
 * API for PRODUCT
 *======================== */
Route::get('/products', 'Api\ProductsAPIControler@products');

/*========================
 * API for REGIONS
 *======================== */
Route::get('/regions', 'Api\ProductsAPIControler@regions');

/*========================
 * API for DASHBOARD
 *======================== */
Route::get('/dashboard/{tipsterId}', 'Api\DashboardAPIController@dashboard');

/*========================
 * API for LOGIN
 *======================== */
Route::post('/login', 'Api\LoginAPIController@login');

/*========================
 * API for MESSAGES
 *======================== */
Route::get('/message-new/{tipsterId}', 'Api\MessagesAPIController@messagesNew');
Route::get('/message-all/{tipsterId}', 'Api\MessagesAPIController@messagesAll');
Route::get('/message-detail/{messageId}', 'Api\MessagesAPIController@show');

/*========================
 * API for USERS
 *======================== */
Route::get('/user/show/{tipsterId}', 'Api\UsersAPIController@show');
Route::get('/user/edit/{tipsterId}', 'Api\UsersAPIController@showUpdate');
Route::post('/user/edit', 'Api\UsersAPIController@update');

