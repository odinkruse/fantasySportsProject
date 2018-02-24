<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = ['name'];
    public function races()
    {
        return $this->hasMany('Race');
    }
}
