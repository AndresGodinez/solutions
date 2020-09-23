<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FechaPromesa extends Model
{
    protected $table = 'fecha_promesa';

    protected $connection = 'logistica';

    public function detalles():HasMany
    {
        return $this->hasMany(FechaPromesaDetalle::class, 'pedido', 'pedido');
    }
}
