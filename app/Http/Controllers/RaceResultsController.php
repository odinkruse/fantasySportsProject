<?php

namespace App\Http\Controllers;

use App\NascarStandardPoints;
use App\RaceResults;
use App\Race;
use App\Car;
use App\Driver;
use App\Season;
use App\Team;
use App\TeamCars;
use App\TeamThirdStandings;
use App\CarThirdStandings;
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
        $data->view = "race-results-index-view";
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
        $data->json->races = Race::where('resultsImported', false)->get();
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

        $raceData = json_decode($request->raceData);

        $third = Third::where('id',$raceData->race->third_id)->first();

        $race = Race::where('id',$raceData->race->id)->first();
        $client = new Client();
        $html = $client->request('GET', $raceData->url);
        $table = $html->filterXPath('//table[@class="tb"][3]');
        $tableArray = $table->filter('tr')->each(function ($row) {
            return $rowArray = $row->filter('td')->each(function ($cell) {
                return preg_replace("/[^A-Za-z0-9 ]/", '', preg_replace('/\n/', "", $cell->text()));
            });
        });
        //$resultArray = array();
        foreach($tableArray as $row)
        {
            if(!empty($row)) {
                $teamCarData = $this->getTeamForCar($row[self::CAR], $third->id);
                $queryObj = new \stdClass();
                $queryObj->teamCarData = $teamCarData;
                $queryObj->race_id = $race->id;
                $queryObj->team_id = $teamCarData->teamNumber;
                $queryObj->car_id = $teamCarData->car_id;
                $queryObj->driver_id = $this->getDriverId($row[self::DRIVER], $teamCarData->car_id, $race->third->season->id);
                $queryObj->position = $row[self::POSITION];
                $queryObj->points = $row[self::POINTS];
                $result = RaceResults::where('race_id',$queryObj->race_id)
                    ->where('team_id',$queryObj->team_id)
                    ->where('car_id',$queryObj->car_id)
                    ->where('driver_id',$queryObj->driver_id)
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
                    $result->standardPoints = NascarStandardPoints::where('position', $result->position)->first()->points;
                    $result->save();
                }
                //array_push($resultArray, $result);
            }
        }
        //return [$resultArray];
        $race->raceResultsURL = $raceData->url;
        $race->resultsImported = 1;
        $race->save();
//        $this->updateThirdStandings($race);
        return ["third"=>$race->third];//["newRaceData",RaceResults::where('race_id', $race->id)->get()];
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
    public function showRaceResults(Race $race)
    {
        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->raceResultsByTeam = $this->showRaceResultsByTeam($race);
        $data->json->raceResultsByCar = $this->showRaceResultsByCar($race);
        $data->json->nextRace = $this->getNextRace($race);
        $data->json->lastRace = $this->getLastRace($race);
        $data->json->race = $race;
        $data->view = "race-results-view";
        return view('main')->with("data",$data);
    }
    public function showRaceResultsByTeam(Race $race)
    {
        $teamResultsArray = array();
        $teams = Team::get();

        foreach($teams as $team)
        {
            array_push($teamResultsArray,
                [
                    "Team"=>$team,
                    "Results"=>$this->getTeamRaceResults($team->id, $race->id),
                    "TotalPoints"=>array_sum(RaceResults::where('race_id', $race->id)->where('team_id',$team->id)->pluck('points')->toArray()) - array_sum(RaceResults::where('race_id', $race->id)->where('team_id',$team->id)->pluck('penalty')->toArray())
                ]
            );
        }
        return $teamResultsArray;
    }
    public function showRaceResultsByCar(Race $race)
    {
        $formattedResultsArray = array();
        $raceResults = $race->results;
        foreach($raceResults as $result)
        {
            $raceResult = new \stdClass();
            $raceResult->position = $result->position;
            $raceResult->carNumber = $result->car->number;
            $raceResult->driver = $raceResult->driver = (
                $result->driver->suffix == null ?
                $result->driver->firstName." ".$result->driver->lastName :
                $result->driver->firstName." ".$result->driver->lastName." ".$result->driver->suffix
            );
            $result->driver->firstName." ".$result->driver->lastName." ".$result->driver->suffix;
            $raceResult->points = $result->points;
            $raceResult->penalty = $result->penalty;
            $raceResult->standardPoints = $result->standardPoints;
            $raceResult->team = $result->team_id;
            array_push($formattedResultsArray,$raceResult);
        }
        return $formattedResultsArray;
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
            $resultObj->penalty = $result->penalty;
            array_push($teamResults, $resultObj);
        }
        return $teamResults;
    }

    private function getNextRace($race)
    {
        $third = $race->third;
        $season = $race->third->season;
        $thirdNo = $race->third->thirdNo;
        $seasonYear = $race->third->season->year;
        $nextRace = Race::where('raceNo','>',$race->raceNo)->where('third_id',$third->id)->orderBy('raceNo')->first();
        if($nextRace == null)
        {
            if($thirdNo == 3)
            {
                $seasonYear++;
                $nextRace = getNextRaceBySeason($seasonYear);
            }
            else
            {
                $thirdNo++;
                $nextRace = $this->getNextRaceByThird($season, $thirdNo);
            }
        }
        return $nextRace;
    }
    private function getLastRace($race)
    {
        $third = $race->third;
        $season = $race->third->season;
        $thirdNo = $race->third->thirdNo;
        $seasonYear = $race->third->season->year;
        $lastRace = Race::where('raceNo','<',$race->raceNo)->where('third_id',$third->id)->orderByDesc('raceNo')->first();
        if($lastRace == null)
        {
            if($thirdNo == 1)
            {
                $seasonYear--;
                $season = Season::where('year',$seasonYear)->first();
                if($season != null) {
                    $thirdIDs = Third::where('season_id',$season->id)->pluck('id')->toArray();
                    $lastRace = Race::whereIn('third_id', $thirdIDs)->orderByDesc('raceNo')->first();
                }
            }
            else
            {
                $thirdNo--;
                $third = Third::where('season_id', $season->id)->where('thirdNo', $thirdNo)->first();
                $lastRace = Race::where('third_id', $third->id)->orderByDesc('raceNo')->first();
            }
        }
        return $lastRace;
    }
    private function getNextRaceBySeason($year)
    {
        $season = Season::where('year',$year)->first();
        if($season != null) {
            $thirdIDs = Third::where('season_id',$season->id)->pluck('id')->toArray();
            return Race::whereIn('third_id', $thirdIDs)->orderBy('raceNo')->first();
        }
        else{
            return null;
        }
    }
    private function getNextRaceByThird($season, $thirdNo)
    {

        $third = Third::where('season_id', $season->id)->where('thirdNo', $thirdNo)->first();
        if($third != null) {
            return Race::where('third_id', $third->id)->orderBy('raceNo')->first();
        }
        else{
            if($thirdNo+1 == 3)
            {
                $season = Season::where('year', $season->year+1)->first();
               return $this->getNextRaceBySeason($season->year);
            }
            else
            {
                return $this->getNextRaceByThird($season, $thirdNo+1);
            }
        }
    }
}
