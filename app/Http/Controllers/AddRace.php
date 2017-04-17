<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;

class AddRace extends Controller
{
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
        $data = $this->scrape($request->url);
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
    public function scrape($url){
        $client = new Client();
//        $url = 'http://www.nascar.com/en_us/monster-energy-nascar-cup-series/standings/results/2017/oreilly-auto-parts-500.html';
//        $url = 'http://www.nascar.com/en_us/monster-energy-nascar-cup-series/standings/results/2017/daytona-500.html';

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
