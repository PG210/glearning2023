<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $table = "log_changes";
    //

    protected $fillable = [
        'id',
        'model_name',
        'recurso_id',
        'user_id',
        'accion_realizada'
    ];

}
