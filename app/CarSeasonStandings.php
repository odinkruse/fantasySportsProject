<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarSeasonStandings extends Model
{
    public function season()
    {
        return $this->belongsTo('App\Season');
    }
    public function cars()
    {
        return $this->belongsToMany('App\Car');
    }
}
