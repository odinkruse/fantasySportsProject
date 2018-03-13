<?php

namespace App\Http\Controllers;

use App\CarThirdStandings;
use App\TeamThirdStandings;
use App\Third;
use App\Season;
use App\Team;
use App\Car;
use App\Driver;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $data->json->teamThirdStandings = $this->formatTeamThirdStandings($third);
        $data->json->carThirdStandings = $this->formatCarThirdStandings($third);
        return ["Team Standings"=>$data->json->teamThirdStandings, "Car Standings"=>$data->json->carThirdStandings];
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
