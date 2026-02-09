<?php

namespace App\Filament\Resources\Estadios;

use App\Filament\Resources\Estadios\Pages\CreateEstadio;
use App\Filament\Resources\Estadios\Pages\EditEstadio;
use App\Filament\Resources\Estadios\Pages\ListEstadios;
use App\Filament\Resources\Estadios\Schemas\EstadioForm;
use App\Filament\Resources\Estadios\Tables\EstadiosTable;
use App\Models\Estadio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EstadioResource extends Resource
{
    protected static ?string $model = Estadio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Estadios';

    public static function form(Schema $schema): Schema
    {
        return EstadioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EstadiosTable::configure($table);
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
            'index' => ListEstadios::route('/'),
            'create' => CreateEstadio::route('/create'),
            'edit' => EditEstadio::route('/{record}/edit'),
        ];
    }
}
