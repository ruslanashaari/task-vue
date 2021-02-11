<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function () {

    Route::get('task-list', 'App\Http\Controllers\Api\TaskApiController@getList')->name('api.task.list');
	Route::post('task-create', 'App\Http\Controllers\Api\TaskApiController@create')->name('api.task.create');
	Route::post('task-update/{id}', 'App\Http\Controllers\Api\TaskApiController@update')->name('api.task.update');
	Route::get('task-delete/{id}', 'App\Http\Controllers\Api\TaskApiController@delete')->name('api.task.delete');

});
