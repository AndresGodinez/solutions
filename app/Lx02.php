<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lx02 extends Model
{
    const CREATED_AT = 'fecha';
    protected $connection = 'logistica';
    protected $table = 'inventario_lx02';

}
