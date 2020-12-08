<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolIngCsat extends ModelBase
{
    protected $table    = "sol_ing_csat";
	protected $fillable = ['idsol', 'ing_q1', 'ing_q2', 'ing_usr_agnt', 'update_date' ];
	public $timestamps = false;
}
