<?php

namespace App\Models;

use App\Enums\StatusEntrada;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\RoundBlockSizeMode;

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
        'codigo_qr',
    ];

    protected $casts = [
        'status' => StatusEntrada::class,
        'precio_final' => 'decimal:2',
    ];

    public function getQrCodeImageAttribute(): string
    {
        if (!$this->codigo_qr) {
            return '';
        }

        // Creamos el QR usando el campo en la base de datos
        $qrCode = new QrCode(
            data: $this->codigo_qr,
            encoding: new Encoding('UTF-8'),
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin
        );

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return $result->getDataUri();
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
    public function partido(): BelongsTo
    {
        return $this->belongsTo(Partido::class);
    }

    public function Asiento(): BelongsTo
    {
        return $this->belongsTo(Asiento::class);
    }

}
