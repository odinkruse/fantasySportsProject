<?php

namespace App\Http\Controllers;

use App\Car;
use App\Team;
use App\TeamCars;
use App\Third;
use Illuminate\Http\Request;

class TeamCarsController extends Controller
{
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
     * @param  \App\TeamCars  $third
     * @return \Illuminate\Http\Response
     */
    public function show(Third $third)
    {
        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->teamCarList = array();
        $data->json->third = $third;
        $teams = Team::get();
        foreach($teams as $team)
        {
            $teamCars = new \stdClass();
            $teamCars->teamNumber = $team->number;
            $teamCars->member1 = $team->member1;
            $teamCars->member2 = $team->member2;
            $thirdTeamCars = TeamCars::where('team_id', $team->id)->where('third_id', $third->id)->get();
            $teamCars->carList = array();
            foreach($thirdTeamCars as $teamCar)
            {
                $carInfo = new \stdClass();
                //$car = Car::where('id', $team->car_id)->first();
                $carInfo->carNumber = $teamCar->car->number;
                $carInfo->drivers = $teamCar->car->drivers;
                array_push($teamCars->carList, $carInfo);
            }
            array_push($data->json->teamCarList, $teamCars);
        }

        $data->view = 'team-cars-view';
        return view('main')->with("data",$data);

    }
    public function showCurrentTeamCars(){
        $third = Third::where('active', 1)->first();
        return $this->show($third);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamCars  $teamCars
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamCars $teamCars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamCars  $teamCars
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamCars $teamCars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamCars  $teamCars
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamCars $teamCars)
    {
        //
    }
}
