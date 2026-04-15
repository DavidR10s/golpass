<?php

namespace App\Models;

use App\Enums\StatusEntrada;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrada extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'order_id',
        'partido_id',
        'asiento_id',
        'status',
        'precio_final',
    ];

    protected $casts = [
        'status' => StatusEntrada::class,
        'precio_final' => 'decimal:2',
    ];

    public function partido(): BelongsTo
    {
        return $this->belongsTo(Partido::class);
    }

    public function Asiento(): BelongsTo
    {
        return $this->belongsTo(Asiento::class);
    }

}
