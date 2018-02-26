<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamCars;
use App\Third;
use App\Season;
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

    public function updateThirdStandingsView()
    {
        $data = new \stdClass();
        $data->json = new \stdClass;
        $data->view = "update-third-standings-view";
        return view('main')->with("data",$data);
    }
    /**
     * @return array
     */
    public function updateThirdStandings(Request $request)
    {
        //return $request;
        $data = $request->thirdData;

        if(strcmp ( (string)date("m/d/Y") , $data['auth'] ) != 0)
        {
            return ["Failed Auth"=>[$data['auth'],date("m/d/Y")]];
        }

        $third = Third::where('season_id', Season::where('year',$data['year'])
            ->first()->id)->where('thirdNo', $data['third'])
            ->first();

        $races = $third->races->pluck('id')->toArray();
//            Race::where('third_id', $third->id)
//            ->pluck('id')
//            ->toArray();

        $carArray = RaceResults::whereIn('race_id', $races)
            ->select('car_id')
            ->groupBy('car_id')
            ->get();
        //return["CarIdArray"=>$car_idArray];
        foreach($carArray as $car)
        {
            $carStanding = CarThirdStandings::firstOrNew(
                ["car_id"=>$car->car_id],
                ["third_id"=>$third->id]
            );
            $carStanding->points = array_sum(RaceResults::where('car_id', $car->car_id)->whereIn('race_id', $races)->pluck('points')->toArray());
            $carStanding->save();
        }

        //*
        ///I need to go through the races in the third
        ///from those races i need to go through the cars in
        ///
        ///
        ///
        //*
        $teams = Team::get();
        $teamThirdResultsArray = array();
        foreach($teams as $team)
        {
            $cars = TeamCars::where('team_id', $team->id)->where('third_id', $third->id)->pluck('car_id')->toArray();

            $teamThirdTeam = TeamThirdStandings::firstOrCreate(
                ['team_id'=>$team->id],
                ['third_id'=>$third->id]
            );

            //should update this to just get a plucked array and just add them with array_sum
            $thirdPoints = 0;

            $thirdPoints = array_sum(RaceResults::wherein('car_id', $cars)->wherein('race_id', $third->races->pluck('id')->toArray())->pluck('points')->toArray());

            $teamThirdTeam->points = $thirdPoints;
            $teamThirdTeam->save();
            array_push($teamThirdResultsArray, [$teamThirdTeam, $cars, $thirdPoints]);
        }
        return ["ThirdStandings"=>[CarThirdStandings::where('third_id', $third->id)->get(),TeamThirdStandings::where('third_id', $third->id)->get()]];

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
