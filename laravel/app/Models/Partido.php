<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partido extends Model
{
    //
    use HasFactory;
    protected $fillable =[
        'estadio_id',
        'equipo_local_id',
        'equipo_visitante_id',
        'precio_base',
        'fecha',
        'finalizado'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'finalizado' => 'boolean'
    ];

    public function Estadio(): BelongsTo
    {
        return $this->belongsTo(Estadio::class);
    }

    public function equipoLocal(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }

    public function equipoVisitante():BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
    }

    public function entradas(): HasMany
    {
        return $this->hasMany(Entrada::class);
    }
    
    public function asientos(): HasMany
    {
        return $this->hasMany(Asiento::class);
    }
}
