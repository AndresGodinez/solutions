<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialABC extends Model
{
    public $timestamps = false;
    protected $connection = 'logistica';
    protected $table = 'materiales_abc';

    public function lx02()
    {
        return $this->belongsTo(Lx02::class,'material' , 'material');
    }

    public function reciboBin()
    {
        return $this->belongsTo(ReciboBin::class,'material' , 'material');
    }
}
