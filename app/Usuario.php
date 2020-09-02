<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $table = 'usuarios';

    public $timestamps = false;

    public function country():BelongsTo
    {
        return $this->belongsTo(
            Country::class,
            'id_contry',
            'id'
        );
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(
            Region::class,
            'id_region',
            'id'
        );
    }
}
