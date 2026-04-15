<?php

namespace App\Models;

use App\Enums\StatusReservacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    /** @use HasFactory<\Database\Factories\ReservacionFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'asiento_id',
        'expira_en',
        'status',
    ];
    protected $casts = [
        'status' => StatusReservacion::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function asiento()
    {
        return $this->belongsTo(Asiento::class);
    }

}
