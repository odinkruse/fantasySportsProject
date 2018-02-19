<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    public function races()
    {
        return $this->hasMany('Race');
    }
}
