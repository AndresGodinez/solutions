<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function is_null;

class IngRegistro extends Model
{
    public $timestamps = false;
    protected $table = 'ing_registro';

    public function lineaRel(): BelongsTo
    {
        return $this->belongsTo(IngLinea::class, 'linea', 'idlinea');
    }

    public function tipoRel(): BelongsTo
    {
        return $this->belongsTo(IngTipo::class, 'tipo', 'idtipo');
    }

    public function scopeModelo(Builder $query, $modelo = null):Builder
    {
        return !is_null($modelo)
            ? $query->orWhere('modelo', 'like', "%$modelo%")
            : $query;
    }

    public function scopeTipo(Builder $query, $tipo = null):Builder
    {
        return !is_null($tipo)
            ? $query->where('tipo', $tipo)
            : $query;
    }

    public function scopeLinea(Builder $query, $linea = null):Builder
    {
        return !is_null($linea)
            ? $query->where('linea', $linea)
            : $query;
    }
}
