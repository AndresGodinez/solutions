<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespuestaSolicitud extends ModelBase
{
	//
	protected $table    = "respuestas_solicitud";
	protected $fillable = ['id_solicitud','id_pregunta','respuesta','ruta', 'fecha'];

}
