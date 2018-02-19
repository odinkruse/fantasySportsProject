<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function cars()
    {
        return $this->hasMany('App\TeamCars');
    }
    public function  thirdStandings()
    {
        return $this->hasMany('App\TeamThirdStandings');
    }
    public function seasonStandings()
    {
        return $this->hasMany('App\TeamSeasonStandings');
    }
    public function results()
    {
        return $this->hasMany('App\RaceResults');
    }
}
