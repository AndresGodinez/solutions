<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    protected $table = 'wpx_menu_region';

    public function country():BelongsTo
    {
        return $this->belongsTo(
            Country::class,
            'id_country'
        );
    }
}
