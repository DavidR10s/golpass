<?php
namespace App\Enums;

enum StatusReservacion: string
{
    case ACTIVA = 'activa';
    case EXPIRADA = 'expirada';
    case CANCELADA = 'cancelada';
}

?>