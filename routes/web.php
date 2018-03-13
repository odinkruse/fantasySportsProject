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
Route::get('/team-results/race/{race}', 'RaceResultsController@showRaceResults');
Route::get('/team-cars/third/{third}', 'TeamCarsController@show');
Route::get('/team-cars/current', 'TeamCarsController@showCurrentTeamCars');
Route::get('/race-results-list','RaceResultsController@index');
Route::get('/update-third-standings', 'ThirdController@updateThirdStandingsView');
Route::get('/third-standings','ThirdStandingsController@index');
Route::get('/third-standings/{third}','ThirdStandingsController@show');
//POST
Route::post('/add-race-results', 'RaceResultsController@store');
Route::post('/update-third-standings', 'ThirdController@updateThirdStandings');
//Route::post('/update-season-standings', 'SeasonController@updateSeasonStandings');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
