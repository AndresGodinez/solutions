<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAyuda extends ModelBase
{
    //
    protected $table    = "ing_tipo";
	protected $fillable = ['idtipo','tipo'];
}
