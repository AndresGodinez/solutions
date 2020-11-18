<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboFolioDetalle extends Model
{
    public $timestamps = false;
    protected $connection = 'logistica';
    protected $table = 'recibo_folios_detalle';
    protected $guarded = [];

}
