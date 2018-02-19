<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function teams()
    {
        return $this->hasMany('App\TeamCars');
    }
    public function  thirdStandings()
    {
        return $this->hasMany('App\CarThirdStandings');
    }
    public function seasonStandings()
    {
        return $this->hasMany('App\CarSeasonStandings');
    }
    public function results()
    {
        return $this->hasMany('App\RaceResults');
    }
}
