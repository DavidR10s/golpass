<?php

namespace App\Models;

use App\Enums\StatusOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    /*protected $fillable = [
        'partido_id',
        'user_id',
        'monto_total',
        'status',
        //'session_id', -- PARA IMPLEMENTAR STRIPE
    ];*/
    protected $fillable = [
        'user_id',
        'asiento_id',
        'numero_pedido',
        'cantidad_total',
        'status',
    ];

    protected $casts = [
        'status' => StatusOrder::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function Entrada() : HasMany
    {
        return $this->hasMany(Entrada::class);
    }

    public function  Pago() : HasMany {
        return $this->hasMany(Pago::class);
    }
}
