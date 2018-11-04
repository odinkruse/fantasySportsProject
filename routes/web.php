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
//Route::get('/update-third-standings', 'ThirdStandingsController@updateThirdStandingsView');
//Route::get('/update-season-standings', 'SeasonStandingsController@updateSeasonStandingsView');
Route::get('/update-race-results/{race}', 'RaceResultsController@edit');
Route::get('/third-standings','ThirdStandingsController@index');
Route::get('/third-standings/{third}','ThirdStandingsController@show');
Route::get('/season-standings','SeasonStandingsController@index');
Route::get('/season-standings/{season}','SeasonStandingsController@show');
Route::get('/the-wes-bet','Home@wesBet');
Route::get('/add-race','RaceController@Create');

//POST
Route::post('/add-race-results', 'RaceResultsController@store');
//Route::post('/update-third-standings', 'ThirdStandingsController@updateThirdStandings');
//Route::post('/update-season-standings', 'SeasonStandingsController@updateSeasonStandings');
Route::post('/add-race','RaceController@Store');
//Route::post('/update-season-standings', 'SeasonController@updateSeasonStandings');
Route::post('/update-race-results', 'RaceResultsController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
