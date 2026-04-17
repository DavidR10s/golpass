<?php

namespace App\Filament\Resources\Reservacions\Schemas;

use App\Enums\StatusReservacion;
use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;


class ReservacionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Select::make('user_id')
                    ->relationship('user', 'id')
                    ->required(),
                Select::make('asiento_id')
                    ->relationship('asiento', 'id')
                    ->required(),
                TextInput::make('expira_en')
                    ->required()
                    ->dateTime(),
                TextInput::make('status')
                    ->required()
                    ->options(StatusReservacion::class)
                    ->default('activa'),
            ]);
    }
}
