<?php

namespace App\Models;

use App\Enums\StatusAsiento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asiento extends Model
{
    /** @use HasFactory<\Database\Factories\AsientoFactory> */
    use HasFactory;
    protected $fillable = [
        'partido_id',
        'sector',
        'fila',
        'numero',
        'status',
    ];

    protected $casts = [
        'status' => StatusAsiento::class,
    ];

    public function partido(): BelongsTo
    {
        return $this->belongsTo(Partido::class);
    }
    
    public function reservacion()
    {
        return $this->hasOne(Reservacion::class);
    }

    public function entrada()
    {
        return $this->hasOne(Entrada::class);
    }

    public function getStatusColor($seleccionados = [])
    {
        if (in_array($this->id, $seleccionados)) 
        {
            return 'bg-indigo-600 ring-4 ring-indigo-300';
        }

        return match($this->status) 
        {
            'vendido'   => 'bg-amber-600 cursor-not-allowed',
            'reservado' => 'bg-gray-600',
            'disponible' => 'bg-green-500 hover:bg-green-600',
            default      => 'bg-gray-400',
        };
    }

}
