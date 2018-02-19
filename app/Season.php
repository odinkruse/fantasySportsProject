<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function thirds()
    {
        return $this->hasMany('App\Third');
    }
    public function teamStandings()
    {
        return $this->hasOne('App\TeamSeasonStandings');
    }
    public function carStandings()
    {
        return $this->hasOne('App\CarSeasonStandings');
    }
}
