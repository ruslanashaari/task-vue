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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('task-list', 'App\Http\Controllers\Api\TaskApiController@getList');
Route::post('task-create', 'App\Http\Controllers\Api\TaskApiController@create');
Route::post('task-update/{id}', 'App\Http\Controllers\Api\TaskApiController@update');
Route::get('task-delete/{id}', 'App\Http\Controllers\Api\TaskApiController@delete');
