<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //many to many relationships
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function positions()
    {
        return $this->belongsToMany('App\Position');
    }
}
