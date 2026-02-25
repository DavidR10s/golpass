<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entrada extends Model
{
    //
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

}
