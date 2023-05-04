<?php

namespace App\PosUsuModel;

use Illuminate\Database\Eloquent\Model;

class GruposModel extends Model
{
    protected $table = 'grupos';//crea un modelo la cual esta apuntando a la tabla carga users
    protected $primarykey = 'id';
}