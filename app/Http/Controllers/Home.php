<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

use App\Race;

use App\TeamSeasonStandings;

use App\Season;

use App\TeamThirdStandings;

use App\Third;


class Home extends Controller
{
    public function view(){

        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->season = Season::where('active', 1)->first();
        $data->json->race = Race::where('active', 1)->first();
        $data->json->track = $data->json->race->track;
        $data->json->teamStandings = array();
        //foreach(TeamThirdStandings::where('third_id', $data->json->race->third_id)->get() as $teamThirdStanding)
        foreach(Team::get() as $team)
        {
            $teamStandingData = new \stdClass();
            $teamStandingData->member1 = explode(" ", $team->member1)[0];
            $teamStandingData->member2 = explode(" ", $team->member2)[0];
            $teamStandingData->teamNumber = $team->id;
            $teamStandingData->thirdPoints = \DB::table('view_team_third_points')->where('team_id',$team->id)->where('third_id', $data->json->race->third_id)->first()->third_points;
            $teamStandingData->seasonPoints = \DB::table('view_team_season_points')->where('team_id',$team->id)->where('season_id', $data->json->season->id)->first()->season_points;
            array_push($data->json->teamStandings, $teamStandingData);
        }

        $data->json->recentRaceResults = Race::where('third_id',Third::where('active', 1)->first()->id)->where('resultsImported', 1)->orderByDesc('raceNo')->get();
        $data->view = "home-view";
//        $data = "Coming from Home Controller";
        return view('main')->with("data",$data);
    }
    public function wesBet(){
        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->view = "the-wes-bet-view";
//        $data = "Coming from Home Controller";
        return view('main')->with("data",$data);
    }
}
