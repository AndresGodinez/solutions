<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboFactura extends Model
{
    protected $table = 'recibo_facturas';
    protected $connection = 'logistica';
}
