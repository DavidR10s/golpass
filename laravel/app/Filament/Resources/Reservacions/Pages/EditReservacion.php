<?php

namespace App\Filament\Resources\Reservacions\Pages;

use App\Filament\Resources\Reservacions\ReservacionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReservacion extends EditRecord
{
    protected static string $resource = ReservacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
