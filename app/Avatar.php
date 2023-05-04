<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    //
    public function upgrades()
    {
        return $this->belongsToMany('App\Upgrade');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
