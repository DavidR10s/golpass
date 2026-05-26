<?php
namespace App\Enums;

enum StatusOrder: string
{
    case COMPLETADO = 'completado';
    case PENDIENTE = 'pendiente';
    case EXPIRADA = 'expirada';
    case FALLIDO = 'fallido';
}

?>