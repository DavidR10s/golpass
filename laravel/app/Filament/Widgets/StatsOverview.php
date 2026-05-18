<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Pago;
use App\Models\Partido;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;


class StatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;
        $users = User::query()
            ->whereBetween('created_at',[$startDate, $endDate])
            ->count();

        $pagos = Pago::query()
            ->whereBetween('created_at',[$startDate, $endDate])
            ->count();

        /*$ingresos = Pago::query()
            ->whereBetween('created_at',[$startDate, $endDate])
            ->sum('monto_total');*/

        $partidos = Partido::query()
            ->whereBetween('created_at',[$startDate, $endDate])
            ->count();

        return [
            //
            Stat::make('Usuarios Totales', $users)
            ->description('Usuarios Registrados')
            ->descriptionIcon('heroicon-m-user-group')
            ->color('warning'),

            Stat::make('Partidos Totales', $partidos)
            ->description('Partidos Registrados')
            ->descriptionIcon('heroicon-m-calendar-days')
            ->color('info'),

            Stat::make('Pagos Totales', $pagos)
            ->description('Pagos Registrados')
            ->descriptionIcon('heroicon-m-qr-code')
            ->color('success'),

            /*Stat::make('ingresos Totales', '€'.number_format($ingresos, 2))
            ->description('ingresos Registrados')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('danger'),*/
        ];
    }
}
