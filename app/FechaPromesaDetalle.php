<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FechaPromesaDetalle extends Model
{
    protected $table = 'fecha_promesa_detalle';
    protected $connection = 'logistica';

    public function fechaPromesa():BelongsTo
    {
        return $this->belongsTo(FechaPromesa::class, 'pedido', 'pedido');
    }
}
