<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTipoInformacion extends ModelBase
{
    //
    protected $table    = "sol_ing_sub_tipo";
	protected $fillable = ['id','sub_tipo','id_tipo'];
}
