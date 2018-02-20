<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarThirdStandings extends Model
{
    protected $fillable = ['car_id', 'third_id'];
    public function third()
    {
        return $this->belongsTo('App\Third');
    }
    public function cars()
    {
        return $this->belongsToMany('App\Car');
    }
}
