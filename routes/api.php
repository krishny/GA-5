<?php

use Illuminate\Http\Request;

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


Route::post('user', 'API\UserController@storeUser')->name('storeUser');
Route::post('user/{id}', 'API\UserController@updateUser')->name('updateUser');
Route::delete('user/{id}', 'API\UserController@deleteUser')->name('deleteUser');

Route::post('agent', 'API\AgentController@storeAgent')->name('storeAgent');
Route::post('agent/{agentId}', 'API\AgentController@updateAgent')->name('updateAgent');
Route::delete('agent/{agentId}', 'API\AgentController@deleteAgent')->name('deleteAgent');

Route::get('user/{id}', 'API\UserController@getUser')->name('getUser');

Route::post('introducer', 'API\IntroducerController@storeIntroducer')->name('storeIntroducer');
Route::post('introducer/{introducerId}', 'API\IntroducerController@updateIntroducer')->name('updateIntroducer');
Route::delete('introducer/{introducerId}', 'API\IntroducerController@deleteIntroducer')->name('deleteIntroducer');

Route::get('introducer/{id}', 'API\IntroducerController@getIntroducer')->name('getIntroducer');

