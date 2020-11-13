<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialBin extends Model
{
    public $timestamps = false;
    protected $connection = 'logistica';
    protected $table = 'materiales_bin';
}
