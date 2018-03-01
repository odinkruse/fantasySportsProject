<?php

namespace App\Http\Controllers;

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
        $data->json->seasonStandings = TeamSeasonStandings::where('season_id', $data->json->season->id)->get();
        $data->json->thirdTeamStandings = array();
        foreach(TeamThirdStandings::where('third_id', $data->json->race->third_id)->get() as $teamThirdStanding)
        {
            $teamStandingData = new \stdClass();
            $teamStandingData->member1 = explode(" ", $teamThirdStanding->team->member1)[0];
            $teamStandingData->member2 = explode(" ", $teamThirdStanding->team->member2)[0];
            $teamStandingData->teamNumber = $teamThirdStanding->team_id;
            $teamStandingData->points = $teamThirdStanding->points;
            array_push($data->json->thirdTeamStandings, $teamStandingData);
        }

        $data->json->recentRaceResults = Race::where('third_id',Third::where('active', 1)->first()->id)->where('resultsImported', 1)->orderByDesc('raceNo')->get();
        $data->view = "home-view";
//        $data = "Coming from Home Controller";
        return view('main')->with("data",$data);
    }
}
