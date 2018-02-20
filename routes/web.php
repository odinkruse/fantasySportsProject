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
//DEV

//GET
Route::get('/', 'Home@view');
Route::get('/add-race-results', 'RaceResultsController@create');
Route::get('/test-dump', 'TestDumpController@viewTestDump');
Route::get('/latest-race-results', 'RaceResultsController@showLatestResults');
Route::get('/team-standings-current-third', 'TeamThirdStandingsController@showActive');
Route::get('/team-standings-current-season', 'TeamSeasonStandingsController@showActive');
//POST
//Route::post('/add-race-results', 'RaceResultsController@store');
//Route::post('/update-third-standings', 'ThirdController@updateThirdStandings');
//Route::post('/update-season-standings', 'SeasonController@updateSeasonStandings');
