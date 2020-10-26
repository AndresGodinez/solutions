<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialABC extends Model
{
    public $timestamps = false;
    protected $connection = 'logistica';
    protected $table = 'materiales_abc';
}
