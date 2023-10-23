<?php

namespace App\PosUsuModel;

use Illuminate\Database\Eloquent\Model;

class CapituloModel extends Model
{
    protected $table = 'chapters';//crea un modelo la cual esta apuntando a la tabla carga users
    protected $primarykey = 'id';
}


