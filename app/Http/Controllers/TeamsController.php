<?php

namespace App\Http\Controllers;

use App\Teams;
use Illuminate\Http\Request;


class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new \stdClass();
        $data->json = Teams::get();
        $data->view = 'add-third-view';
        return view('main')->with("data",$data);
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
        return ['from TeamsController',$request->formData];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teams  $teamList
     * @return \Illuminate\Http\Response
     */
    public function show(Teams $teamList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teams  $teamList
     * @return \Illuminate\Http\Response
     */
    public function edit(Teams $teamList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teams  $teamList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teams $teamList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teams  $teamList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teams $teamList)
    {
        //
    }
}
