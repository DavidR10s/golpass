<?php

namespace App\Filament\Resources\Estadios\Pages;

use App\Filament\Resources\Estadios\EstadioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEstadio extends EditRecord
{
    protected static string $resource = EstadioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
