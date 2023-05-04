<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subchapter extends Model
{
    //
    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }
    public function competence()
    {
        return $this->belongsTo('App\Competence');
    }
    public function challenges()
    {
        return $this->hasMany('App\Challenge');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
