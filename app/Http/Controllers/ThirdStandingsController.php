<?php

namespace App\Http\Controllers;

use App\CarThirdStandings;
use App\TeamThirdStandings;
use App\Third;
use App\Season;
use App\Team;
use App\Car;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Race;
use App\Driver;
use App\RaceResults;
use Illuminate\Http\Request;

class ThirdStandingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new \stdClass();
        $data->json = new \stdClass;
        $data->json->seasons = array();
        $db_seasons = Season::orderByDesc('year')->get();
        foreach($db_seasons as $db_season)
        {
            $season = new \stdClass();
            $season->name = $db_season->name;
            $season->thirds = $db_season->thirds;
            array_push($data->json->seasons, $season);
        }
        $data->view = "third-standings-index-view";
        return view('main')->with("data",$data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Third $third)
    {
        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->third = $third;
        $data->json->teamThirdStandings = $this->formatTeamThirdStandings($third);
        $data->json->carThirdStandings = $this->formatCarThirdStandings($third);
        $data->view = "third-standings-view";
        return view('main')->with('data',$data);
    }
    public function updateThirdStandingsView()
    {
        $data = new \stdClass();
        $data->json = new \stdClass;
        $data->json->thirds = Third::orderByDesc('active')->get();
        $data->view = "update-third-standings-view";
        return view('main')->with("data",$data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updateThirdStandings(Request $request)
    {
        $thirdData = json_decode($request->thirdData);

        $third = Third::where('id', $thirdData->third->id)->first();

        $raceIDs = $third->races->pluck('id')->toArray();
        $teamIDs = Team::get()->pluck('id')->toArray();


        //*
        //Team Third Standings  & Team Car Standings NEW
        //*

        foreach($raceIDs as $raceID)
        {
            $raceNo = Race::where('id', $raceID)->first()->raceNo;
            $raceColumn = "race_".($raceNo - (12*($third->thirdNo - 1)))."_points";
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
        return ["season"=>$third->season];//["ThirdStandings"=>[CarThirdStandings::where('third_id', $third->id)->get(),TeamThirdStandings::where('third_id', $third->id)->get()]];

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function formatTeamThirdStandings(Third $third)
    {
        $teamStandings = DB::table('team_third_standings')->
            join('teams', 'team_third_standings.team_id', '=', 'teams.id')->
            where('team_third_standings.third_id', $third->id)->
            select('teams.number','teams.member1','teams.member2','team_third_standings.*')->orderByDesc('total_points')->get();
        return $teamStandings;
    }
    public function formatCarThirdStandings(Third $third)
    {
        $carStandings = DB::table('car_third_standings')->
            join('cars','car_third_standings.car_id','=','cars.id')->
            where('car_third_standings.third_id', $third->id)->
            select('cars.number','car_third_standings.*')->orderByDesc('total_points')->get();
        foreach($carStandings as $carStanding)
        {
            $carStanding->drivers = Driver::where('car_id',$carStanding->car_id)->
                where('season_id', $third->season->id)->select('firstName','lastName','suffix')->get();
        }
        return $carStandings;
    }
}
