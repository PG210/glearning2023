<?php

namespace App\PosUsuModel;

use Illuminate\Database\Eloquent\Model;

class SubcapUser extends Model
{
    protected $table = 'subchapter_user';//crea un modelo la cual esta apuntando a la tabla carga users
    protected $primarykey = 'id';
}
