<?php

namespace App\Filament\Resources\Estadios\Pages;

use App\Filament\Resources\Estadios\EstadioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEstadios extends ListRecords
{
    protected static string $resource = EstadioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
