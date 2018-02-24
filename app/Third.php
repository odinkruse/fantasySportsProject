<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Third extends Model
{
    protected $fillable = ['season_id', 'thirdNo'];
    public function races()
    {
        return $this->hasMany('App\Race');
    }
    public function teamStandings()
    {
        return $this->hasOne('App\TeamThirdStandings');
    }
    public function carStandings()
    {
        return $this->hasOne('App\CarThirdStandings');
    }
    public function season()
    {
        return $this->belongsTo('App\Season');
    }
}
