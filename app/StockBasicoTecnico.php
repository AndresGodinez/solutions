<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockBasicoTecnico extends Model
{
    public $timestamps = false;
    protected $table = 'stockbasico_tecnico';

    protected $connection = 'logistica';
}
