<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function results()
    {
        return $this->hasMany('App\RaceResults');
    }
}
