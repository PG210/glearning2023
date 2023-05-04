<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insignia extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    protected $fillable = [
        'name',
        'imagen',
        's_point',
        'i_point',
        'g_point',
        'description'
    ];
}
