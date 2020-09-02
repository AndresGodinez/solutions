<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $table = 'materiales';

    public function sustitutos(): HasMany
    {
        return $this->hasMany(
            MaterialSustituto::class,
            'id_material',
            'id'
        );
    }
}
