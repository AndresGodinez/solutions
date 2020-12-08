<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevisionIngenieria extends ModelBase
{
    protected $table    = "revision_ingenieria";
	protected $fillable = ['idsol', 'comentarios', 'ruta', 'fecha_comentario' ];
}
