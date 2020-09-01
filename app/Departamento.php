<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    protected $table = 'pex_departamentos';

    public function usuarios(): HasMany
    {
        return $this->hasMany(
            Usuario::class,
            'depto'
        );
    }
}
