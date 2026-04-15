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

    

}
