<?php

namespace App\Archivos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargarchivo extends Model
{
    protected $table = 'carga_users';//crea un modelo la cual esta apuntando a la tabla carga users
    //protected $primarykey = 'id';//cambia el nombre de la llame primaria tal cual esta en la tabla no es obligatorio 
    //public $timestamps = false; //en caso de que no quiera utilizar para llenar datos con fecha y hora
}
