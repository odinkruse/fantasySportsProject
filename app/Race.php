<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = ['third_id', 'track_id','name','raceNo','raceDate','raceResults'];
    public function results()
    {
        return $this->hasMany('App\RaceResults')->orderBy('position');
    }
    public function track()
    {
        return $this->belongsTo('App\Track');
    }
    public function third()
    {
        return $this->belongsTo('App\Third');
    }
}
