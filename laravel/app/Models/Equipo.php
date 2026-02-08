<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    //
    protected $fillable = [
        'nombre', 
        'localidad',
        'logo_url'
    ];

    public function localMatches(): HasMany
    {
        return $this->hasMany(Partido::class, 'local_equipo_id');
    }

    public function visitorMatches(): HasMany
    {
        return $this->hasMany(Partido::class, 'visitante_equipo_id');
    }
}
