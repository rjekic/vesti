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

Route::get('/', 'WelcomeController@index');
Route::get('search', 'WelcomeController@search');

Route::get('oglasinaslovna', 'WelcomeController@indexOglasi');
Route::get('searchOglasi', 'WelcomeController@searchOglasi');
Route::get('searchOglasi/{search}', 'WelcomeController@searchJategortijeOglasi')->name('Pretraga');

Auth::routes();

Route::get('home', 'HomeController@index')->name('nalog');
Route::get('homeoglasisearch', 'HomeController@homesearchOglasi')->name('Pretraga');

Route::get('novioglas', 'HomeController@novioglas')->name('novoglas');
Route::post('createoglas', 'HomeController@createOglas');
Route::get('obrisioglas/{id}', 'HomeController@deleteoglas');

