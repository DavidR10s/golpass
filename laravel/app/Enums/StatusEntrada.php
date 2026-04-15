<?php
namespace App\Enums;

enum StatusEntrada: string
{
    case CANCELADO = 'cancelado';
    case RESERVADO = 'reservado';
    case VENDIDO = 'vendido';
}

?>