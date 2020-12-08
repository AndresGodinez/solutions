<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentosAyuda extends ModelBase
{
    //
    protected $table    = "ing_registro";
	protected $fillable = ['titulo','archivo_carga','modelo'];
}
