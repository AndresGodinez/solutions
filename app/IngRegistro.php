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

    public function scopePalabra(Builder $query, $palabra = null):Builder
    {
        return !is_null($palabra)
            ? $query->orWhere('palabra', 'like', "%$palabra%")
            : $query;
    }

    public function scopeCategoria(Builder $query, $categoria = null):Builder
    {
        return !is_null($categoria)
            ? $query->orWhere('categoria', 'like', "%$categoria%")
            : $query;
    }

    public function scopeTitulo(Builder $query, $titulo = null):Builder
    {
        return !is_null($titulo)
            ? $query->orWhere('titulo', 'like', "%$titulo%")
            : $query;
    }

    public function scopeComentario(Builder $query, $comentario = null):Builder
    {
        return !is_null($comentario)
            ? $query->orWhere('comentarios', 'like', "%$comentario%")
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
