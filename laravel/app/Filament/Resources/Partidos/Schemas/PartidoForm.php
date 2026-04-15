<?php

namespace App\Filament\Resources\Partidos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PartidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('estadio_id')
                    ->relationship('estadio', 'id')
                    ->required(),
                Select::make('equipo_local_id')
                    ->relationship('equipoLocal', 'id')
                    ->required(),
                Select::make('equipo_visitante_id')
                    ->relationship('equipoVisitante', 'id')
                    ->required(),
                TextInput::make('precio_base')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('fecha')
                    ->required(),
                Toggle::make('finalizado')
                    ->required(),
            ]);
    }
}
