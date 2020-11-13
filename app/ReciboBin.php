<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboBin extends Model
{
    const CREATED_AT = 'fecha';
    protected $connection = 'logistica';
    protected $table = 'recibo_bins';
}
