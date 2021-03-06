<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TallerInfo extends Model
{
    protected $table = 'talleres_info';
    protected $primaryKey  = 'taller';
    public $timestamps = false;
    protected $fillable = [
    	'taller',
		'direccion',
		'estado',
		'cp',
		'contacto',
		'responsable',
		'colonia',
		'cabecera',
		'correo',
		'fecha_centralizado',
		'telefono'
    ];
   
}
