<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
