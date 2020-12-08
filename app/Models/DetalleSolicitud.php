<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends ModelBase
{
    protected $table    = "detalle_solicitud";
	protected $fillable = ['id_sol','fecha_envio','status','usuario','responsable','fecha_revision','fecha_cerrada','fecha_rechazada'];
	public $timestamps = false;
}
