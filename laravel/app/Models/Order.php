<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        'partido_id',
        'user_id',
        'monto_total',
        'status',
        //'session_id', -- PARA IMPLEMENTAR STRIPE
    ];

    public function Entrada() : HasMany
    {
        return $this->hasMany(Entrada::class);
    }

    public function  Pago() : HasMany {
        return $this->hasMany(Pago::class);
    }
}
