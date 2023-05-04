<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    //

    protected $fillable = [
        'name',
        's_point',
        'i_point',
        'g_point',
        'description'
    ];


    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
