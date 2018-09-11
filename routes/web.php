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

Route::get('/', 'HomeController@index');
Route::get('/projects', 'ProjectController@index');
Route::get('/projects/{project}', 'ProjectController@show');
Route::get('/agency', staticView('agency.index'));
Route::get('/agency/publications', staticView('agency.publications'));
