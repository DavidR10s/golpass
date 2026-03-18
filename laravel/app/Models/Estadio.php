<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estadio extends Model
{
    //
    use HasFactory;
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
