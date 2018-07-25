<?php

namespace App\Http\Controllers;

use App\CarSeasonStandings;
use App\TeamSeasonStandings;
use Illuminate\Http\Request;
use App\CarThirdStandings;
use App\TeamThirdStandings;
use App\Third;
use App\Season;
use App\Team;
use App\Car;
use App\Driver;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SeasonStandingsController extends Controller
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
        $data->json->seasons = Season::orderByDesc('year')->get();
        $data->view = "season-standings-index-view";
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
    public function show(Season $season)
    {
        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->season = $season;
        $data->json->teamSeasonStandings = $this->formatTeamSeasonStandings($season);
        $data->json->carSeasonStandings = $this->formatCarSeasonStandings($season);
        $data->view = "season-standings-view";
        return view('main')->with('data',$data);
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
    public function updateSeasonStandingsView()
    {
        $data = new \stdClass();
        $data->json = new \stdClass;
        $data->json->seasons = Season::orderByDesc('year')->get();
        $data->view = "update-season-standings-view";
        return view('main')->with("data",$data);
    }
    public function updateSeasonStandings(Request $request)
    {
        $seasonData = json_decode($request->seasonData);
        $season = Season::where('id', $seasonData->season->id)->first();
        $teamIDs = Team::get()->pluck('id')->toArray();
        $thirdIDs = Third::where('season_id', $season->id)->pluck('id')->toArray();
        foreach($teamIDs as $teamID)
        {
            $teamSeasonRecord = TeamSeasonStandings::where('team_id',$teamID)->
            where('season_id', $season->id)->first();
            if($teamSeasonRecord == null)
            {
                $teamSeasonRecord = new TeamSeasonStandings();
                $teamSeasonRecord->team_id = $teamID;
                $teamSeasonRecord->season_id = $season->id;
            }
            $teamSeasonRecord->points = array_sum(TeamThirdStandings::where('team_id', $teamID)->
            whereIn('third_id',$thirdIDs)->pluck('total_points')->toArray());
            $teamSeasonRecord->save();
        }
        $seasonCarIDs = CarThirdStandings::whereIn('third_id',$thirdIDs)->distinct()->pluck('car_id')->toArray();

        foreach($seasonCarIDs as $carID)
        {
            $carSeasonRecord = CarSeasonStandings::where('car_id', $carID)->
                where('season_id', $season->id)->first();
            if($carSeasonRecord == null)
            {
                $carSeasonRecord = new CarSeasonStandings();
                $carSeasonRecord->car_id = $carID;
                $carSeasonRecord->season_id = $season->id;
            }
            $carSeasonRecord->points = array_sum(CarThirdStandings::where('car_id',$carID)->
            whereIn('third_id',$thirdIDs)->pluck('total_points')->toArray());
            $carSeasonRecord->save();
        }
        return "success";
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
    public function formatTeamSeasonStandings(Season $season)
    {
        $teamStandings = DB::table('team_season_standings')->
        join('teams', 'team_season_standings.team_id', '=', 'teams.id')->
        where('team_season_standings.season_id', $season->id)->
        select('teams.number','teams.member1','teams.member2','team_season_standings.*')->orderByDesc('points')->get();
        return $teamStandings;
    }
    public function formatCarSeasonStandings(Season $season)
    {
        $carStandings = DB::table('car_season_standings')->
        join('cars','car_season_standings.car_id','=','cars.id')->
        where('car_season_standings.season_id', $season->id)->
        select('cars.number','car_season_standings.*')->orderByDesc('points')->get();
        foreach($carStandings as $carStanding)
        {
            $carStanding->drivers = Driver::where('car_id',$carStanding->car_id)->
            where('season_id', $season->id)->select('firstName','lastName','suffix')->get();
        }
        return $carStandings;
    }
}
