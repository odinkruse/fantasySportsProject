<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = ['year', 'name'];
    public function thirds()
    {
        return $this->hasMany('App\Third');
    }
    public function teamStandings()
    {
        return $this->hasOne('App\TeamSeasonStandings');
    }
    public function carStandings()
    {
        return $this->hasOne('App\CarSeasonStandings');
    }
}
