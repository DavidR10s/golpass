<?php

namespace App\Filament\Resources\Pagos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PagoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('metodo_pago')
                    ->required(),
                DatePicker::make('fecha_pago')
                    ->required(),
                TextInput::make('monto_total')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                TextInput::make('usuario')
                    ->required()
                    ->numeric(),
                TextInput::make('entrada')
                    ->required()
                    ->numeric(),
            ]);
    }
}
