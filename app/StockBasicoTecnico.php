<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockBasicoTecnico extends Model
{
    protected $table = 'stockbasico_tecnico';

    protected $connection = 'logistica';
}
