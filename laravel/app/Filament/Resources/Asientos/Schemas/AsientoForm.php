<?php

namespace App\Filament\Resources\Asientos\Schemas;

use App\Enums\StatusAsiento;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AsientoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('partido_id')
                    ->relationship('partido', 'id')
                    ->required(),
                TextInput::make('sector')
                    ->required(),
                TextInput::make('fila')
                    ->required(),
                TextInput::make('numero')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(StatusAsiento::class)
                    ->default('disponible')
                    ->required(),
            ]);
    }
}
