<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WpxLigasSustitutos extends Model
{
    public $timestamps = false;
    protected $table = 'wpx_ligas_sustitutos';
    protected $fillable = [
        'id_status', 'np', 'np_sust', 'np_sust_descr', 'depto_ing',
        'depto_mat', 'depto_ven', 'usr_request', 'usr_depto', 'created_at'
    ];
}
