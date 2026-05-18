<?php

namespace App\Filament\Resources\Pagos\Schemas;

use App\Enums\StatusPago;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PagoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order_id')
                    ->relationship('order', 'id')
                    ->required(),
                Select::make('metodo_pago')
                    ->options(['stripe' => 'Stripe', 'paypal' => 'Paypal', 'credit_card' => 'Credit card'])
                    ->required(),
                DatePicker::make('fecha_pago')
                    ->required(),
                TextInput::make('transaccion_id'),
                Select::make('status')
                    ->options(StatusPago::class)
                    ->required(),
                TextInput::make('payload_completo'),
            ]);
    }
}
