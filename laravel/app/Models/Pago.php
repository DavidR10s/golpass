<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pago extends Model
{
    //
    protected $fillable =[
        'metodo_pago',
        'fecha_pago',
        'monto_total',
        'entrada',
        'usuario'
    ];

    protected $casts =[
        'fecha_pago' => 'date',
        'monto_total' => 'double'
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
