<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class WebScraper extends Controller
{


    public function index(){
        $data = $this->scrape();
        return $data;
//        return view('welcome', compact('data'));
    }
    public function scrape(){
        $client = new Client();
//        $url = 'http://www.nascar.com/en_us/monster-energy-nascar-cup-series/standings/results/2017/oreilly-auto-parts-500.html';
        $url = 'http://www.nascar.com/en_us/monster-energy-nascar-cup-series/standings/results/2017/daytona-500.html';

        $html = $client->request('GET', $url);
        $html->filter('tr > td')->each(function($element){
            $fString =preg_replace('/\n|\s+/',"",$element->text());
            array_push($this->td, $fString);

        });
        $uRows = explode(",,",implode(',',$this->td));
        $fRows = array();
        foreach($uRows as $row){
            $row = ltrim($row, ',');
            array_push($fRows,explode(",", $row));
        }
        return $fRows;
    }
}
