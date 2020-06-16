<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function tests()
    {
        return $this->hasMany('App\Test');
    }
}
