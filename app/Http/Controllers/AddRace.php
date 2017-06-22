<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cars;

use App\Races;

use App\Results;

use App\Drivers;

use Goutte\Client;

class AddRace extends Controller
{
    public $scrapedData = array();
    const POS = 0;
    const DRIVER = 1;
    const CAR = 2;
    const MANUFACTURER = 3;
    const LAPS = 4;
    const START = 5;
    const LED = 6;
    const PTS = 7;
    const BONUS = 8;
    const PENALTY = 9;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $td = array();

    public function view()
    {
        $data = new \stdClass();
        $data->json = new \stdClass;
        $data->view = "add-race-view";
        return view('welcome')->with("data",$data);
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
        $data = $this->scrape($request->formData);
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function scrape($formData){
        $client = new Client();
        $html = $client->request('GET', $formData['url']);
        $html->filter('tr > td')->each(function ($element) {
            $fString = preg_replace('/\n/', "", $element->text());
            array_push($this->scrapedData, $fString);
        });
        $this->scrapedData = array_slice($this->scrapedData,11);
        $finalArr = array_chunk($this->scrapedData, 10);
        $formData['resultsArray'] = $finalArr;
        $checkRace = $this->findRace($formData['raceName'],date('Y-m-d',strtotime($formData['raceDate'])));
//        return ["checkrace",$checkRace];
        if($checkRace == null || $checkRace->id == null){
            $this->insertRace($formData);
            $newRace = $this->findRace($formData['raceName'],date('Y-m-d',strtotime($formData['raceDate'])));
            $all_the_things = $this->parseResults($formData, $newRace->id);
            return ["nailed it", $all_the_things];
        }
        else{
            $all_the_things = $this->parseResults($formData, $checkRace->id);
            return ["checkrace", $all_the_things];
        }
    }
    private function parseResults($resultsObj, $raceID){
        for($i = 0; $i<count($resultsObj['resultsArray']); $i++){
            $carNumber = $this->matchDriverToCarNumber($resultsObj['resultsArray'][$i][self::DRIVER]);
//            return [$resultsObj['resultsArray'][$i][self::DRIVER], $carNumber, $resultsObj];
            if($carNumber == null || $carNumber->carNumber ==null){
                return ["driver name not correct, or in DB", $resultsObj['resultsArray'][$i][self::DRIVER]];
            }
            $resultsObj['resultsArray'][$i][self::CAR] = $carNumber->carNumber;
            $checkCar = $this->findCar($resultsObj['resultsArray'][$i][self::CAR]);
            if($checkCar == null || $checkCar->id == null){
                $this->insertCar($resultsObj['resultsArray'][$i]);
                $checkNewCar = $this->findCar($resultsObj['resultsArray'][$i][self::CAR]);
                $this->insertResult($resultsObj['resultsArray'][$i], $raceID, $checkNewCar->id);
            }
            else{
                $this->insertResult($resultsObj['resultsArray'][$i], $raceID, $checkCar->id);
            }
        }
    }
    private function findRace($name, $date){
        return Races::select(['id'])->where([['name', $name],['raceDate',$date]])->first();
    }
    private function findCar($carNumber){
        return Cars::select(['id'])->where('carNumber', $carNumber)->first();
    }
    private function matchDriverToCarNumber($driver){
        return Drivers::select(['carNumber'])->where('name', $driver)->first();
    }
    private function insertRace($dataArray){
            $races = new Races();
            $races->raceNo = (int)$dataArray['raceNumber'];
            $races->name = $dataArray['raceName'];
            $races->track = $dataArray['track'];
            $races->laps = (int)$dataArray['laps'];
            $races->raceDate = date('Y-m-d',strtotime($dataArray['raceDate']));
            $races->save();
    }
    private function insertCar($carArray){
//        $carNumber = Drivers::select(['carNumber'])->where('name', $carArray[self::DRIVER])->first();
//        $carArray[self::CAR] = $carNumber;
        $cars = new Cars();
        $cars->carNumber = (int)$carArray[self::CAR];
        $cars->driver = $carArray[self::DRIVER];
        $cars->save();
    }
    private function insertResult($resultData, $raceID, $carID){
        $results = new Results();
        $results->carID = (int)$carID;
        $results->raceID = (int)$raceID;
        $results->position = (int)$resultData[self::POS];
        $results->lapsCompleted = (int)$resultData[self::LAPS];
        $results->startPosition = (int)$resultData[self::START];
        $results->points = (int)$resultData[self::PTS];
        $results->bonusPoints = (int)$resultData[self::BONUS];
        $results->penalty = (int)$resultData[self::PENALTY];
        $results->save();
    }
}
