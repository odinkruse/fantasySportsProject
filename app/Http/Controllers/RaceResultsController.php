<?php

namespace App\Http\Controllers;

use App\RaceResults;
use App\Race;
use App\Car;
use App\Driver;
use App\TeamCars;
use App\Third;
use Goutte\Client;
use Illuminate\Http\Request;

class RaceResultsController extends Controller
{
    const POS = 0;
    const START = 1;
    const CAR = 2;
    const DRIVER = 3;
    const SPONSOR_OWNER = 4;
    const MANUFACTURER = 5;
    const LAPS = 6;
    const STATUS = 7;
    const LED = 8;
    const PTS = 7;
    const PLAYOFF_POINTS = 8;
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


        $data = new \stdClass();
        $data->json = new \stdClass();
        $client = new Client();
        $html = $client->request('GET', $request->formData['url']);
        $table = $html->filterXPath('//table[@class="tb"][3]');
        $tableArray = $table->filter('tr')->each(function ($row) {
            return $rowArray = $row->filter('td')->each(function ($cell) {
                return preg_replace('/\n/', "", $cell->text());
            });
        });
        $data->json->tableArray = $tableArray;
        $third = Third::where('active',1)->first();
        $race = Race::where('raceNo', $request->formData['raceNumber'])->where('thirdId', $third->id)->first();
        foreach($tableArray as $row) {
            $results = new RaceResults();
            $results->raceId = $race->id;
            $teamCarData = $this->getTeamForCar($row[self::CAR], $third->Id);
            $results->teamNumber = $teamCarData->teamNumber;
            $results->carId = $teamCarData->carId;
            $results->driverId = $this->getDriverId($row[self::DRIVER]);


        }
        return ["data",$race->name];
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
    public function showActive()
    {
        $data = new \stdClass();
        $data->json = new \stdClass();
        $activeRace = Race::where('active', 1)->get();
        $data->json->raceResults = $activeRace->results;
        $data->view = "active-race-results-view";
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
    public function getDriverId($driverName)
    {
        $formattedDriver = str_replace(',','',$driverName);
        $driverArray = explode(' ', $formattedDriver);
        if(count($driverArray) == 2){
            $driver = Driver::where('firstName', $driverArray[0])->where('lastName', $driverArray[1])->get();
            $driverCount = Driver::count($driver);
            if($driverCount != 0)
            {
                return $driver->first()->id;
            }
            else
            {
                //create new driver
            }
        }
        else if(count($driverArray) == 3)
        {
            //check/create a driver with a first name last name and suffix
        }
    }
    public function getTeamForCar($carNumber, $thirdId){
        $teamCarData = new \stdClass();
        $car = Car::where('number', $carNumber)->first();
        $team = TeamCars::where('carId', $car->id)->where('thirdId', $thirdId)->first();
        $teamCarData->teamNumber = $team->number;
        $teamCarData->carId = $car->id;
        return $teamCarData;
    }
}
