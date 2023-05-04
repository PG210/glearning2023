<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //
    public function subchapters()
    {
        return $this->hasMany('App\Subchapter');
    }
}
