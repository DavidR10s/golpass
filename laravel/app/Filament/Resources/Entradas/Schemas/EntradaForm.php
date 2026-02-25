<?php

namespace App\Filament\Resources\Entradas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EntradaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('partido_id')
                    ->relationship('partido', 'id')
                    ->required(),
                TextInput::make('n_asientos')
                    ->required()
                    ->numeric(),
                TextInput::make('sector')
                    ->required(),
                Select::make('status')
                    ->options(['disponible' => 'Disponible', 'reservado' => 'Reservado', 'vendido' => 'Vendido'])
                    ->required(),
                TextInput::make('precio')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
            ]);
    }
}
