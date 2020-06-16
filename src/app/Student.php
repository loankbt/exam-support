<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Student extends Model implements AuthenticatableContract
{
    use Authenticatable;

    public function shift()
    {
        return $this->belongsTo('App\Shift');
    }
}
