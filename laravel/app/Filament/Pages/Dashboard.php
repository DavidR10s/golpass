<?php
namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Panel;

class Dashboard extends BaseDashboard
{
    // ...
    use HasFiltersForm;
    
    public function getColumns(): int|array
    {
        //return parent::getColumns();
        return 1;
    }
     public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        DatePicker::make('startDate'),
                        DatePicker::make('endDate'),
                        // ...
                    ])
                    ->columns(1),
            ]);
    }
}


?>