<?php
namespace App\Enums;

enum StatusPago : string
{
    case EXITO = 'exito';
    case DENEGADO = 'denegado';
    case PENDIENTE = 'pendiente';
}

?>