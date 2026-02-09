<?php

namespace App\Filament\Resources\Estadios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EstadioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('ciudad')
                    ->required(),
                TextInput::make('capacidad')
                    ->required()
                    ->numeric(),
            ]);
    }
}
