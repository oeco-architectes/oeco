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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('news', 'Api\NewsController@index');
Route::get('news/{news}', 'Api\NewsController@show');
Route::post('news', 'Api\NewsController@store');
Route::put('news/{news}', 'Api\NewsController@update');
Route::delete('news/{news}', 'Api\NewsController@delete');

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
