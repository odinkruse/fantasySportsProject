<?php

namespace App\Http\Controllers;

use App\RaceResults;
use App\Race;
use App\Car;
use App\Driver;
use App\Season;
use App\Team;
use App\TeamCars;
use App\Third;
use App\Track;
use \DateTime;
use Goutte\Client;
use Illuminate\Http\Request;

class RaceResultsController extends Controller
{
    const POSITION = 0;
    const START = 1;
    const CAR = 2;
    const DRIVER = 3;
    const SPONSOR_OWNER = 4;
    const MANUFACTURER = 5;
    const LAPS = 6;
    const STATUS = 7;
    const LED = 8;
    const POINTS = 9;
    const PLAYOFF_POINTS = 10;
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
        $seasons = Season::orderByDesc('year')->get();
        foreach($seasons as $season)
        {
            $seasonObj = new \stdClass();
            $seasonObj->name = $season->name;
            $thirdsArray = $season->thirds->pluck('id')->ToArray();
            $races = Race::wherein('third_id', $thirdsArray)->where('resultsImported', true)->orderByDesc('raceNo')->get();
            $seasonObj->races = $races;
            array_push($data->json->seasons, $seasonObj);
        }
        $data->view = "race-results-list-view";
        return view('main')->with("data",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new \stdClass();
        $data->json = new \stdClass;
        $data->view = "add-race-results-view";
        return view('main')->with("data",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->formData;

        if(strcmp ( (string)date("m/d/Y") , $data['auth'] ) != 0)
        {
            return ["Failed Auth"=>[$data['auth'],date("m/d/Y")]];
        }

        //should really validate the data
        $season = Season::firstOrCreate(
            ['year'=>$data['season']]
        );
        if($season->name == null)
        {
            $season->name = $season->year." Season";
            $season->save();
        }

        $third = Third::firstOrCreate(
            ['season_id'=>$season->id],
            ['thirdNo'=>$data['third']]
        );
        if($third->name == null)
        {
            $numberToNameArray = ["First", "Second", "Third"];
            $third->name = $numberToNameArray[$third->thirdNo-1]." Third of ".$season->year;
            $third->save();
        }

        $track = Track::firstOrCreate(
            ['name'=>$data['track']]
        );
        $race = Race::where('third_id',$third->id)
            ->where('track_id',$track->id)
            ->where('raceNo',(int)$data['raceNumber'])
            ->first();
        if($race == null) {
            $race = new Race();
            $race->third_id = $third->id;
            $race->track_id = $track->id;
            $race->raceNo = (int)$data['raceNumber'];
            $race->name = $data['raceName'];
            $race->raceDate = DateTime::createFromFormat('m-d-Y', $data['raceDate'])->format('Y-m-d');
            $race->save();
        }
        $client = new Client();
        $html = $client->request('GET', $data['url']);
        $table = $html->filterXPath('//table[@class="tb"][3]');
        $tableArray = $table->filter('tr')->each(function ($row) {
            return $rowArray = $row->filter('td')->each(function ($cell) {
                return preg_replace("/[^A-Za-z0-9 ]/", '', preg_replace('/\n/', "", $cell->text()));
            });
        });
        $resultArray = array();
        foreach($tableArray as $row)
        {
            if(!empty($row)) {
                $teamCarData = $this->getTeamForCar($row[self::CAR], $third->id);
                $queryObj = new \stdClass();
                $queryObj->teamCarData = $teamCarData;
                $queryObj->race_id = $race->id;
                $queryObj->team_id = $teamCarData->teamNumber;
                $queryObj->car_id = $teamCarData->car_id;
                $queryObj->driver_id = $this->getDriverId($row[self::DRIVER], $teamCarData->car_id, $season->id);
                $queryObj->position = $row[self::POSITION];
                $queryObj->points = $row[self::POINTS];
                $result = RaceResults::where('race_id',$queryObj->race_id)
                    ->where('team_id',$queryObj->team_id)
                    ->where('car_id',$queryObj->car_id)
                    ->where('driver_id',$queryObj->driver_id)
                    ->where('position', $queryObj->position)
                    ->where('points',$queryObj->points)
                    ->first();
                if($result == null)
                {
                    $result = new RaceResults();
                    $result->race_id = $queryObj->race_id;
                    $result->team_id = $queryObj->team_id;
                    $result->car_id = $queryObj->car_id;
                    $result->driver_id = $queryObj->driver_id;
                    $result->position = $queryObj->position;
                    $result->points = $queryObj->points;
                    $result->save();
                }
                array_push($resultArray, $result);
            }
        }
        //return [$resultArray];
        $race->raceResultsURL = $data['url'];
        $race->resultsImported = 1;
        $race->save();
        return ["newRaceData",RaceResults::where('race_id', $race->id)->get()];
    }

    /**
     * Display the specified resource.
     * *
     * @param  \App\RaceResults  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function show(RaceResults $raceResults)
    {
        //
    }
    public function showRaceResultsByTeam(Race $race)
    {
        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->raceResultsByTeam = array();
        $raceThird = $race->third;
        $teams = Team::get();
        //$race = Race::where('resultsImported', 1)->where('third_id', $raceThird->id)->orderBy('raceNo','desc')->first();
        $data->json->race = $race;
        foreach($teams as $team)
        {
            array_push($data->json->raceResultsByTeam,
                [
                    "Team"=>$team,
                    "Results"=>$this->getTeamRaceResults($team->id, $race->id),
                    "TotalPoints"=>array_sum(RaceResults::where('race_id', $race->id)->where('team_id',$team->id)->pluck('points')->toArray())
                ]
            );
        }
//        $data->json->raceResults = RaceResults
//            ::join('teams', 'race_results.team_id',)
        $data->view = "team-race-results-view";
        return view('main')->with("data",$data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RaceResults  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function edit(RaceResults $raceResults)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RaceResults  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RaceResults $raceResults)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RaceResults  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function destroy(RaceResults $raceResults)
    {
        //
    }
    public function getDriverId($driverName, $car_id, $season_id)
    {
        $driverArray = explode(" ", trim($driverName));
        $firstName = $driverArray[0];
        $lastName = $driverArray[1];
        $suffix = null;
        //$car = Car::where('id', $car_id)->first();
        if(count($driverArray) == 3)
        {
            $suffix = $driverArray[2];
        }
        $driver = Driver:: where('firstNAme',$firstName)
            ->where('lastName',$lastName)
            ->where('car_id', $car_id)
            ->where('season_id', $season_id)
            ->first();
        if($driver == null)
        {
            $driver = new Driver();
            $driver->firstName = $firstName;
            $driver->lastName = $lastName;
            $driver->suffix = $suffix;
            $driver->car_id = $car_id;
            $driver->season_id = $season_id;
            $driver->save();
        }
//        $driver = Driver::firstOrNew(
//            ['firstName'=>$firstName],
//            ['lastName'=>$lastName],
//            ['car_id'=>$car->id],
//            ['season_id'=>$season_id]
//
//        );
//        if($suffix != null && $driver->suffix == null)
//        {
//            $driver->suffix = $suffix;
//            $driver->save();
//        }
        return $driver->id;
    }
    public function getTeamForCar($carNumber, $third_id){
        $teamCarData = new \stdClass();

        $car = Car::firstOrCreate(
            ['number'=>$carNumber]
        );
        $teamCarRow = TeamCars::where('car_id', $car->id)->where('third_id', $third_id)->first();
        if($teamCarRow != null)
        {
            $teamCarData->teamNumber = $teamCarRow->team_id;
        }
        else
        {
            $teamCarData->teamNumber = null;
        }
        $teamCarData->car_id = $car->id;
        return $teamCarData;
    }
    public function getTeamRaceResults($team_id, $race_id)
    {
        $results = RaceResults::where('race_id', $race_id)->where('team_id',$team_id)->get();
        $teamResults = array();
        foreach($results as $result)
        {
            $resultObj = new \stdClass();
            $resultObj->position = $result->position;
            $resultObj->carNumber = Car::where('id', $result->car_id)->first()->number;
            $resultObj->driverName = Driver::select('firstName', 'lastName')->where('id', $result->driver_id)->first();
            $resultObj->points = $result->points;
            array_push($teamResults, $resultObj);
        }
        return $teamResults;
    }
}
