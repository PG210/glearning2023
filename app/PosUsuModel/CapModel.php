<?php

namespace App\PosUsuModel;

use Illuminate\Database\Eloquent\Model;

class CapModel extends Model
{
    protected $table = 'capasig';//crea un modelo la cual esta apuntando a la tabla carga users
    protected $primarykey = 'id';
}

