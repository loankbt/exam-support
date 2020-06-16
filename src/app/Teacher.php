<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function shift()
    {
        return $this->belongsTo('App\Shift');
    }
}
