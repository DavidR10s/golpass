<?php

namespace App\Filament\Resources\Entradas\Schemas;

use App\Enums\StatusEntrada;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EntradaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order_id')
                    ->relationship('order', 'id')
                    ->required(),
                Select::make('asiento_id')
                    ->relationship('asiento', 'id')
                    ->required(),
                Select::make('partido_id')
                    ->relationship('partido', 'id')
                    ->required(),
                Select::make('status')
                    ->options(StatusEntrada::class)
                    ->required(),
                TextInput::make('precio_final')
                    ->required()
                    ->numeric(),
                TextInput::make('codigo_qr')
                    ->required(),
            ]);
    }
}
