<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends ModelBase
{
    //
    protected $table    = 'wpx_menu_region';
	protected $fillable = ['id','name','short_name'];
}
