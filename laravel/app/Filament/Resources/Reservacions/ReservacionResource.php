<?php

namespace App\Filament\Resources\Reservacions;

use App\Filament\Resources\Reservacions\Pages\CreateReservacion;
use App\Filament\Resources\Reservacions\Pages\EditReservacion;
use App\Filament\Resources\Reservacions\Pages\ListReservacions;
use App\Filament\Resources\Reservacions\Schemas\ReservacionForm;
use App\Filament\Resources\Reservacions\Tables\ReservacionsTable;
use App\Models\Reservacion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReservacionResource extends Resource
{
    protected static ?string $model = Reservacion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Reservaciones';

    public static function form(Schema $schema): Schema
    {
        return ReservacionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReservacionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReservacions::route('/'),
            'create' => CreateReservacion::route('/create'),
            'edit' => EditReservacion::route('/{record}/edit'),
        ];
    }
}
