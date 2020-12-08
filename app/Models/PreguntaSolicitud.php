<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntaSolicitud extends ModelBase
{
    //
    protected $table    = "preguntas_solicitud";
	protected $fillable = ['id_pregunta','id_fallo','id_lineaproducto','pregunta','tooltip','tipo','id_tiposolicitud'];
}
