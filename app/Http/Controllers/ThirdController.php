<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamCars;
use App\Third;
use App\Race;
use App\RaceResults;
use App\CarThirdStandings;
use App\TeamThirdStandings;
use Illuminate\Http\Request;

class ThirdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Third  $third
     * @return \Illuminate\Http\Response
     */
    public function show(Third $third)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Third  $third
     * @return \Illuminate\Http\Response
     */
    public function edit(Third $third)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Third  $third
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Third $third)
    {
        //
    }

    /**
     * @return array
     */
    public function updateThirdStandings()
    {

        $third = Third::where('active', 1)->first();
        $races = Race::where('thirdId', $third->id)->pluck('id')->toArray();
        $carArray = RaceResults::whereIn('raceId', $races)->select('carId')->groupBy('carId')->get();
        //return["CarIdArray"=>$carIdArray];
        foreach($carArray as $car)
        {
            $carStanding = CarThirdStandings::firstOrNew(
                ["carId"=>$car->carId],["thirdId"=>$third->id]
            );
            $pointsArray = RaceResults::where('carId', $car->carId)->whereIn('raceId', $races)->pluck('points')->toArray();
            $carStanding->points = array_sum($pointsArray);
            $carStanding->save();
        }


        $teams = Team::get();
        $teamThirdResultsArray = array();
        foreach($teams as $team)
        {
            $cars = TeamCars::where('teamNumber', $team->number)->where('thirdId', $third->id)->get();

            $teamThirdTeam = TeamThirdStandings::firstOrCreate(
                ['teamNumber'=>$team->number],['thirdId'=>$third->id]
            );
            $thirdPoints = 0;
            foreach($cars as $car)
            {
                $thirdPoints += CarThirdStandings::where('carId', $car->carId)->where('thirdId', $third->id)->first()->points;
            }
            $teamThirdTeam->points = $thirdPoints;
            $teamThirdTeam->save();
            array_push($teamThirdResultsArray, [$teamThirdTeam, $cars, $thirdPoints]);
        }
        return ["ThirdStandings"=>[CarThirdStandings::where('thirdId', $third->id)->get(),TeamThirdStandings::where('thirdId', $third->id)->get()]];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Third  $third
     * @return \Illuminate\Http\Response
     */
    public function destroy(Third $third)
    {
        //
    }
}
