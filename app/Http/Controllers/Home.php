<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Races;

use App\Teams;


class Home extends Controller
{
    public function view(){

        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->year = "2017";
        $data->json->races = Races::get();
        $data->json->teams = Teams::get();
        $data->view = "home-view";
//        $data = "Coming from Home Controller";
        return view('welcome')->with("data",$data);
    }
}
