<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialesVendorLeadTime extends Model
{
    public $timestamps = false;
    protected $connection = 'logistica';
    protected $table = 'materiales_vendor_leadtime';
}
