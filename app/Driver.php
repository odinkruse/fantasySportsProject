<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['firstName','lastName', 'suffix',];
    public function results()
    {
        return $this->hasMany('App\RaceResults');
    }
}
