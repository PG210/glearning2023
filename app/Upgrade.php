<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{
    //
    public function avatars()
    {
        return $this->belongsToMany('App\Avatar');
    }
}
