<?php

namespace App\Models;

use App\Enums\StatusPago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pago extends Model
{
    //
    protected $fillable =[
        'order_id',
        'metodo_pago',
        'transaccion_id',
        'status',
        'payload_completo'
    ];

    protected $casts = [
        'status' => StatusPago::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function entrada():HasMany
    {
        return $this->hasMany(Entrada::class);   
    }
}
