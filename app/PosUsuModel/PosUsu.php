<?php

namespace App\PosUsuModel;

use Illuminate\Database\Eloquent\Model;

class PosUsu extends Model
{
    protected $table = 'position_user';//crea un modelo la cual esta apuntando a la tabla carga users
    protected $primarykey = 'id';
}
