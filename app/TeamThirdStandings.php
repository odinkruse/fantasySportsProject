<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamThirdStandings extends Model
{
    public function third()
    {
        return $this->belongsTo('App\Third');
    }
    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }
}
