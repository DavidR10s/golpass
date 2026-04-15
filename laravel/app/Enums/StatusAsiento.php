<?php
namespace App\Enums;

enum StatusAsiento: string
{
    case DISPONIBLE = 'disponible';
    case RESERVADO = 'reservado';
    case DISPONIBLE = 'vendido';
}

?>