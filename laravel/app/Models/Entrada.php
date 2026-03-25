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
        'partido_id',
        'entrada_id',
        'n_asientos',
        'sector',
        'status',
        'precio'
    ];

    public function partido(): BelongsTo
    {
        return $this->belongsTo(Partido::class);
    }

    protected function casts(): array
    {
        return [
            'status' => StatusEntrada::class,
        ];
    }


}
