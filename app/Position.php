<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function areas()
    {
        return $this->belongsToMany('App\Area');
    }

}
