<?php

namespace App\AreaPModel;

use Illuminate\Database\Eloquent\Model;

class AreaPos extends Model
{
    protected $table = 'area_user';//crea un modelo la cual esta apuntando a la tabla carga users
    protected $primarykey = 'id';
    //public $timestamps = false; //en caso de que no quiera utilizar para llenar datos con fecha y hora
}
