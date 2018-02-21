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
        $data->json->seasonStandings = TeamSeasonStandings::where('season_id', $data->json->season->id)->get();
        $data->json->thirdTeamStandings = TeamThirdStandings::where('third_id', $data->json->race->third_id)->get();
        $data->json->recentRaceResults = Race::where('third_id',Third::where('active', 1)->first()->id)->where('resultsImported', 1)->orderByDesc('raceNo')->get();
        $data->view = "home-view";
//        $data = "Coming from Home Controller";
        return view('main')->with("data",$data);
    }
}
