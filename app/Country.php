<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $table = 'wpx_menu_contry';

    public function regiones(): HasMany
    {
        return $this->hasMany(
            Region::class,
            'id_contry'
        );
    }
}
