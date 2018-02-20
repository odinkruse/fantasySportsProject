<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function results()
    {
        return $this->hasMany('App\RaceResults');
    }
    public function track()
    {
        return $this->hasOne('App\Track');
    }
    public function third()
    {
        return $this->belongsTo('App\Third');
    }
}
