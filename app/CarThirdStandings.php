<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarThirdStandings extends Model
{
    protected $fillable = ['carId', 'thirdId'];
    public function third()
    {
        return $this->belongsTo('App\Third');
    }
    public function cars()
    {
        return $this->belongsToMany('App\Car');
    }
}
