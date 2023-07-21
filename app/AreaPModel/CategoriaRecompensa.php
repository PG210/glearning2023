<?php

namespace App\AreaPModel;

use Illuminate\Database\Eloquent\Model;

class CategoriaRecompensa extends Model
{
    protected $table = 'caterecompensas';//crea un modelo la cual esta apuntando a la tabla carga users
    protected $primarykey = 'id';
}
