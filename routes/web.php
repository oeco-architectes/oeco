<?php

use App\News;

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

Route::get('/', function () {
    $news = News::whereNotNull('order')->orderBy('order', 'asc')->get();
    return view('home', ['news' => $news]);
});

Route::get('/agence', function () {
    return view('agency');
});
