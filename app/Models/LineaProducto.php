<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaProducto extends ModelBase
{
    //
    protected $table    = "linea_producto";
	protected $fillable = ['id','linea'];
}
