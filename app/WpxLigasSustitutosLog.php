<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WpxLigasSustitutosLog extends Model
{
    public $timestamps = false;
    protected $table = 'wpx_ligas_sustitutos_log';
    protected $fillable = ['id_sol', 'id_status', 'modify_by', 'depto', 'comments', 'rel', 'action', 'modify_date'];
}
