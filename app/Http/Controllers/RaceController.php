<?php

namespace App\Http\Controllers;

use App\Race;
use App\Third;
use App\Track;
use Illuminate\Http\Request;

class RaceController extends Controller
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
        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->tracks = Track::get();
        $data->json->thirds = Third::orderByDesc('active')->get();
        $data->view = "add-race-view";
        return view('main')->with("data",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $raceData = json_decode($request->raceData);
        $race = Race::where('third_id', $raceData->third->id)->where('raceNo',$raceData->raceNumber)->first();
        $race = Race::where('third_id', $raceData->third->id)->where('raceNo',$raceData->raceNumber)->first();
        if($race == null)
        {
            $race = new Race();
            $race->third_id = $raceData->third->id;
            $race->track_id = $raceData->track->id;
            $race->name = $raceData->raceName;
            $race->raceNo = $raceData->raceNumber;
            $race->raceDate = date('Y-m-d',strtotime($raceData->raceDate));
            $race->resultsImported = false;
            $race->active = $raceData->active;
            if($race->active)
            {
                $activeRaces = Race::where('active', true)->get();
                foreach($activeRaces as $activeRace){
                    $activeRace->active = false;
                    $activeRace->save();
                }
            }
            $race->save();
            return ["Race Created"=>$race];
        }
        else {
            //we are in big trouble
            return "fail";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function show(Race $race)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function edit(Race $race)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Race $race)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function destroy(Race $race)
    {
        //
    }
}
