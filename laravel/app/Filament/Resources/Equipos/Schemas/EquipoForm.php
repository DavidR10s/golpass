<?php

namespace App\Filament\Resources\Equipos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EquipoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('localidad')
                    ->required(),
                TextInput::make('logo_url')
                    ->url(),
            ]);
    }
}
