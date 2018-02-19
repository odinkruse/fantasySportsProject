<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamSeasonStandings extends Model
{
    public function season()
    {
        return $this->belongsTo('App\Season');
    }
    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }
}
