<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge_Type extends Model
{
    //laravel no reconoce la tabla, asi que forzosamente se pasa
    public $table = "challenge_types";

    public function challenges()
    {
        return $this->hasMany('App\Challenge');
    }
}
