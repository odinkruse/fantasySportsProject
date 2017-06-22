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

Route::get('/', 'Home@view');
Route::get('/add-race', 'AddRace@view');
Route::get('/add-third','TeamsController@index');
Route::post('/add-race', 'AddRace@store');
Route::post('/add-third','TeamsController@store');
