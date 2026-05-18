<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\StatusOrder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('numero_pedido')
                    ->required(),
                TextInput::make('cantidad_total')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(StatusOrder::class)
                    ->default('pendiente')
                    ->required(),
            ]);
    }
}
