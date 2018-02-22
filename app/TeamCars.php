<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamCars extends Model
{
    public function car()
    {
        return $this->belongsTo('App\Car');
    }
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
