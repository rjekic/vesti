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

Route::get('dogadjajinaslovna', 'WelcomeController@indexDogadjaji');
Route::get('searchDogadjaji', 'WelcomeController@searchDogadjaji');

Auth::routes();

/* Oglasi */

Route::get('home', 'HomeController@index')->name('nalog');
Route::get('homeoglasisearch', 'HomeController@homesearchOglasi')->name('Pretraga');

Route::get('novioglas', 'HomeController@novioglas')->name('novioglas');
Route::post('createoglas', 'HomeController@createOglas');
Route::get('obrisioglas/{id}', 'HomeController@deleteoglas');

/* Dogadjaji */

Route::get('homedogadjaji', 'HomeController@homedogadjaji')->name('Dodadjaji');
Route::get('homedogadjajisearch', 'HomeController@homedogadjajisearch')->name('Pretraga');

Route::get('novidogadjaj', 'HomeController@novidogadjaj')->name('novidogadjaj');
Route::post('createdogadjaj', 'HomeController@createdogadjaj');
Route::get('obrisidogadjaj/{id}', 'HomeController@obrisidogadjaj');
