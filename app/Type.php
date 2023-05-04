<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    public $table = "types";
    protected $fillable = [
        'id', 
        'name',
        'message',
        'g_point',
        'i_point', 
        
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('user_id','id_areas');
    }
}
