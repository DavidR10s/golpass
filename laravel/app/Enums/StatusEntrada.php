<?php
namespace App\Enums;

enum StatusEntrada: string
{
    case DISPONIBLE = 'disponible';
    case RESERVADO = 'reservado';
    case VENDIDO = 'vendido';
}

?>