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
        $data = $request->thirdData;

        if(strcmp ( (string)date("m/d/Y") , $data['auth'] ) != 0)
        {
            return ["Failed Auth"=>[$data['auth'],date("m/d/Y")]];
        }

        $third = Third::where('season_id', Season::where('year',$data['year'])
            ->first()->id)->where('thirdNo', $data['third'])
            ->first();

        $raceIDs = $third->races->pluck('id')->toArray();
        $teamIDs = Team::get()->pluck('id')->toArray();


        //*
        //Team Third Standings  & Team Car Standings NEW
        //*

        foreach($raceIDs as $raceID)
        {
            $raceColumn = "race_".Race::where('id', $raceID)->first()->raceNo."_points";
            $raceResults = RaceResults::where('race_id', $raceID)->get();
            foreach($raceResults as $raceResult)
            {
                $thirdStandingsByCar = CarThirdStandings::where('car_id', $raceResult->car_id)->
                    where('third_id', $third->id)->first();
                if($thirdStandingsByCar == null)
                {
                    $thirdStandingsByCar = new CarThirdStandings();
                    $thirdStandingsByCar->car_id = $raceResult->car_id;
                    $thirdStandingsByCar->third_id = $third->id;
                }
                $thirdStandingsByCar->{$raceColumn} = $raceResult->points - $raceResult->penalty;
                $thirdStandingsByCar->total_points =
                    $thirdStandingsByCar->race_1_points +
                    $thirdStandingsByCar->race_2_points +
                    $thirdStandingsByCar->race_3_points +
                    $thirdStandingsByCar->race_4_points +
                    $thirdStandingsByCar->race_5_points +
                    $thirdStandingsByCar->race_6_points +
                    $thirdStandingsByCar->race_7_points +
                    $thirdStandingsByCar->race_8_points +
                    $thirdStandingsByCar->race_9_points +
                    $thirdStandingsByCar->race_10_points +
                    $thirdStandingsByCar->race_11_points +
                    $thirdStandingsByCar->race_12_points;
                $thirdStandingsByCar->save();
            }

            foreach ($teamIDs as $teamID)
            {
                $thirdStandingsByTeam = TeamThirdStandings::where('team_id',$teamID)->
                where('third_id', $third->id)->first();
                if($thirdStandingsByTeam == null)
                {
                    $thirdStandingsByTeam = new TeamThirdStandings();
                    $thirdStandingsByTeam->team_id = $teamID;
                    $thirdStandingsByTeam->third_id = $third->id;
                }
                $thirdStandingsByTeam->{$raceColumn} = array_sum(
                        RaceResults::where("race_id",$raceID)->
                        where("team_id", $teamID)->
                        pluck('points')->
                        toArray()
                    ) - array_sum(
                        RaceResults::where("race_id",$raceID)->
                        where("team_id", $teamID)->
                        pluck('penalty')->
                        toArray()
                    );
                $thirdStandingsByTeam->total_points =
                    $thirdStandingsByTeam->race_1_points +
                    $thirdStandingsByTeam->race_2_points +
                    $thirdStandingsByTeam->race_3_points +
                    $thirdStandingsByTeam->race_4_points +
                    $thirdStandingsByTeam->race_5_points +
                    $thirdStandingsByTeam->race_6_points +
                    $thirdStandingsByTeam->race_7_points +
                    $thirdStandingsByTeam->race_8_points +
                    $thirdStandingsByTeam->race_9_points +
                    $thirdStandingsByTeam->race_10_points +
                    $thirdStandingsByTeam->race_11_points +
                    $thirdStandingsByTeam->race_12_points;
                $thirdStandingsByTeam->save();
            }

        }
        return "success???";//["ThirdStandings"=>[CarThirdStandings::where('third_id', $third->id)->get(),TeamThirdStandings::where('third_id', $third->id)->get()]];

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
