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
        return $this->hasMany('App\TeamThirdStandings')->orderByDesc('total_points');
    }
    public function carStandings()
    {
        return $this->hasMany('App\CarThirdStandings')->orderByDesc('total_points');
    }
    public function season()
    {
        return $this->belongsTo('App\Season');
    }
}
