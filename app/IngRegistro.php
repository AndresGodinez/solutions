<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IngRegistro extends Model
{
    public $timestamps = false;
    protected $table = 'ing_registro';

    public function lineaRel():BelongsTo
    {
        return $this->belongsTo(IngLinea::class, 'linea', 'idlinea');
    }

    public function tipoRel():BelongsTo
    {
        return $this->belongsTo(IngTipo::class, 'tipo', 'idtipo');
    }
}
