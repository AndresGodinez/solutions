<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModoFallas extends ModelBase
{
    //
    protected $table    = "modo_falla";
	protected $fillable = ['id_modofalla','modo_falla'];
}
