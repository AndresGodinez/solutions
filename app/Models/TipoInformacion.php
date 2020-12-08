<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoInformacion extends ModelBase
{
    //
    protected $table    = "tipo_informacion";
	protected $fillable = ['id','informacion'];
}
