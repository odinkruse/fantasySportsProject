<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceResults extends Model
{
    public function race()
    {
        return $this->belongsToMany('App\Race');
    }
    public function cars()
    {
        return $this->belongsToMany('App\Car');
    }
    public function drivers()
    {
        $this->belongsToMany('App\Driver');
    }
    public function teams()
    {
        $this->belongsToMany('App\Team');
    }
    public function third()
    {
        $this->belongsTo('App\Third');
    }
}
