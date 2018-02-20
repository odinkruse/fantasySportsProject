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


//        $data = new \stdClass();
//        $data->json = new \stdClass();
//        $client = new Client();
//        $html = $client->request('GET', $request->formData['url']);
//        $table = $html->filterXPath('//table[@class="tb"][3]');
//        $tableArray = $table->filter('tr')->each(function ($row) {
//            return $rowArray = $row->filter('td')->each(function ($cell) {
//                return preg_replace("/[^A-Za-z0-9 ]/", '', preg_replace('/\n/', "", $cell->text()));
//            });
//        });
//        $data->json->resultsArray = array();


        $third = Third::where('active',1)->first();
        $race = Race::where('raceNo', $request->formData['raceNumber'])->where('thirdId', $third->id)->first();


//        foreach($tableArray as $row)
//        {
//            if(!empty($row)) {
//
//                $result = new RaceResults();
//                $result->raceId = $race->id;
//                $teamCarData = $this->getTeamForCar($row[self::CAR], $third->id);
//                $result->teamNumber = $teamCarData->teamNumber;
//                $result->carId = $teamCarData->carId;
//                $result->driverId = $this->getDriverId($row[self::DRIVER]);
//                $result->position = $row[self::POSITION];
//                $result->points = $row[self::POINTS];
//
//                $checkDuplicate = RaceResults::where('raceId', $result->raceId)->where('carId', $result->carId)->first();
//                if($checkDuplicate == null) {
//                    $result->save();
//                }
//            }
//        }

        return ["newRaceData",RaceResults::where('raceId', $race->id)->get()];
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
        //$formattedDriver = str_replace(',','',$driverName);
        $driverArray = explode(" ", trim($driverName));

        $driver = Driver::where('firstName', $driverArray[0])->where('lastName', $driverArray[1])->first();

        if($driver != null)
        {
            return $driver->id;
        }
        else
        {
            $newDriver = new Driver();
            $newDriver->firstName = $driverArray[0];
            $newDriver->lastName = $driverArray[1];
            if(count($driverArray) == 3)
            {
                $newDriver->suffix = $driverArray[2];
            }
            $newDriver->save();

            return Driver::where('firstName', $driverArray[0])->where('lastName', $driverArray[1])->first()->id;
        }
    }
    public function getTeamForCar($carNumber, $thirdId){
        $teamCarData = new \stdClass();
        if(Car::where('number', $carNumber)->first() == null)
        {
            $newCar = new Car();
            $newCar->number = $carNumber;
            $newCar->save();
        }
        $car = Car::where('number', $carNumber)->first();
        $teamCarRow = TeamCars::where('carId', $car->id)->where('thirdId', $thirdId)->first();
        if($teamCarRow != null)
        {
            $teamCarData->teamNumber = $teamCarRow->teamNumber;
        }
        else
        {
            $teamCarData->teamNumber = null;
        }
        $teamCarData->carId = $car->id;
        return $teamCarData;
    }
}
