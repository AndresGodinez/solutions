<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WpxSustitutos extends Model
{
    const CREATED_AT = 'fecha_carga';
    public $timestamps = false;
    protected $table = 'wpx_sustitutos';
    protected $fillable = [
        'material', 'sustituto', 'sustituto_sug',
        'group_rel', 'fecha_liga', 'user_carga',
        'fecha_carga'
    ];

    public function material2():BelongsTo
    {
        return $this->belongsTo(Material::class, 'sustituto', 'part_number');
    }

}
