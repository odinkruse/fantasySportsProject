<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function results()
    {
        return $this->hasOne('App\RaceResults');
    }
}
