<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CiclosTemp extends Model
{
    protected $table = 'ciclicos_temp';
    protected $connection = 'logistica';
    public $timestamps = false;

    public static function deletePlanta(string $planta){
        $ciclos = CiclosTemp::where('planta', $planta)->delete();
    }
}
