<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function shift()
    {
        return $this->belongsTo('App\Shift');
    }

    public function scopeShiftExist($query, $id)
    {
        return $query->where('shift_id', $id);
    }
}
