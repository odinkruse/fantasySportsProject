<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceResults extends Model
{
    protected $fillable = ['race_id', 'team_id','car_id','driver_id','position','points','penalty'];
    public function race()
    {
        return $this->belongsTo('App\Race');
    }
    public function car()
    {
        return $this->belongsTo('App\Car');
    }
    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
