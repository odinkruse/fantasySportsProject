<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamThirdStandings extends Model
{
    public function third()
    {
        return $this->belongsTo('App\Third');
    }
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
