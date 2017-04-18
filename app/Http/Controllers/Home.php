<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function view(){

        $data = new \stdClass();
        $data->json = new \stdClass();
        $data->json->year = "2017";
        $data->json->data = \DB::table('test')->get();
        $data->view = "home-view";
//        $data = "Coming from Home Controller";
        return view('welcome')->with("data",$data);
    }
}
