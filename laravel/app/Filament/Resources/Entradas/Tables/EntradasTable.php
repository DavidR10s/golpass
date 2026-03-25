<?php

namespace App\Filament\Resources\Entradas\Tables;

use App\Enums\StatusEntrada;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EntradasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('partido.id')
                    ->searchable(),
                TextColumn::make('n_asientos')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sector')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (StatusEntrada $state): string => match ($state) 
                    {
                        StatusEntrada::DISPONIBLE => 'info',
                        StatusEntrada::RESERVADO => 'gray',
                        StatusEntrada::VENDIDO => 'success',
                    }),
                TextColumn::make('precio')
                    ->numeric()
                    ->prefix('€')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
