<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    public function challenges()
    {
        return $this->belongsToMany('App\Challenge');
    }

    public function quiz_questions()
    {
        return $this->hasMany('App\Quiz_Question');
    }
}
