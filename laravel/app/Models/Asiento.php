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

    public function partido(): BelongsTo
    {
        return $this->belongsTo(Partido::class);
    }

    public function casts(): array
    {
        return [
            'status' => StatusAsiento::class,
        ];
    }

}
