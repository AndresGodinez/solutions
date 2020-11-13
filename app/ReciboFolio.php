<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboFolio extends Model
{
    public $timestamps = false;
    protected $connection = 'logistica';
    protected $table = 'recibo_folios';

    public function materilaesVendorLedTime()
    {
        return $this->belongsTo(MaterialesVendorLeadTime::class, 'vendor', 'vendor');
    }
}
