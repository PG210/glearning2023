<?php

namespace App\PosUsuModel;

use Illuminate\Database\Eloquent\Model;

class GrupadminModel extends Model
{
    protected $table = 'grupadmin';//crea un modelo la cual esta apuntando a la tabla carga users
    protected $primarykey = 'id';
}

