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

    public function equipoLocal(): HasMany
    {
        return $this->hasMany(Partido::class, 'local_equipo_id');
    }

    public function equipoVisitante(): HasMany
    {
        return $this->hasMany(Partido::class, 'visitante_equipo_id');
    }
}
