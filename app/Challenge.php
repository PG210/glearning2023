<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function quizzes()
    {
        return $this->belongsToMany('App\Quiz');
    } 

    public function subchapter()
    {
        return $this->belongsTo('App\Subchapter');
    }

    public function challenge_type()
    {
        return $this->belongsTo('App\Challenge_Type');
    }
}
