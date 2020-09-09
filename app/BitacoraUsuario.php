<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraUsuario extends Model
{
    protected $table = 'bitacora_usuarios';

    protected $fillable = ['usuario_id'];

    public $timestamps = false;
}
