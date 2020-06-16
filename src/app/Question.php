<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function options() {
        return $this->hasMany('App\Option', 'question_id');
    }

    public function subject() {
        return $this->belongsTo('App\Subject');
    }
}
