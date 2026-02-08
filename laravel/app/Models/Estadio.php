<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estadio extends Model
{
    //
    protected $fillable =[
        'nombre',
        'ciudad', 
        'capacidad'
    ];

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class);
    }
}
