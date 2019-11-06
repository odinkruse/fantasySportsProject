<?php

namespace App\Http\Controllers;

use App\WesBet;
use App\Season;
use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WesBetController extends Controller
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
        $data->json->seasons = Season::orderByDesc('year')->get();
        $data->json->cars = Car::orderBy('number')->get();
        $data->view = "add-wes-bet-view";
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
        $betData = json_decode($request->bet);
        $bet = new WesBet();
        $bet->season_id = $betData->season;
        $bet->name = $betData->better;
        $bet->car_id = $betData->car;
        $bet->wins = $betData->wins;
        $bet->points = $betData->points;
        $bet->save();
        return ["bet"=>$bet];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WesBet  $wesBet
     * @return \Illuminate\Http\Response
     */
    public function show(WesBet $wesBet)
    {
        $currentSeason = Season::where('active', '1')->select('id')->first();
        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->betData = DB::table('wes_bets')
            ->join('drivers','wes_bets.car_id','=','drivers.car_id')
            ->join('cars', 'wes_bets.car_id', '=', 'cars.id')
            ->join('view_car_season_points', 'wes_bets.car_id', '=', 'view_car_season_points.car_id')
            ->where('view_car_season_points.season_id', $currentSeason->id)
            ->where('wes_bets.season_id', $currentSeason->id)
            ->where('drivers.season_id', $currentSeason->id)
            ->select('wes_bets.name','wes_bets.points','wes_bets.wins', 'cars.number', 'drivers.firstName','drivers.lastName', 'view_car_season_points.season_points', 'wes_bets.out', 'wes_bets.win')
            ->orderBy('wes_bets.win', 'DESC')
            ->orderBy('wes_bets.out', 'ASC')
            ->orderBy('view_car_season_points.season_points', 'DESC')
            ->get();
        $data->view = "the-wes-bet-view";
        return view('main')->with("data",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WesBet  $wesBet
     * @return \Illuminate\Http\Response
     */
    public function edit(WesBet $wesBet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WesBet  $wesBet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WesBet $wesBet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WesBet  $wesBet
     * @return \Illuminate\Http\Response
     */
    public function destroy(WesBet $wesBet)
    {
        //
    }
}
