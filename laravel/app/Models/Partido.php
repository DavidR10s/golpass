<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partido extends Model
{
    //
    protected $fillable =[
        'estadio_id',
        'local_equipo_id',
        'visitor_equipo_id',
        'match_date',
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
        return $this->belongsTo(Equipo::class, 'local_team_id');
    }

    public function equipoVisitante():BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'visitor_team_id');
    }

    public function entradas(): HasMany
    {
        return $this->hasMany(Entrada::class);
    }
}
