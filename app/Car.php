<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['number'];
    public function teams()
    {
        return $this->hasMany('App\TeamCars');
    }
    public function drivers()
    {
        return $this->hasMany('App\Driver');
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
