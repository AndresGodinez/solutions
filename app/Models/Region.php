<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends ModelBase
{
    //
    protected $table    = 'wpx_menu_contry';
	protected $fillable = ['id','name','short_name'];
}
