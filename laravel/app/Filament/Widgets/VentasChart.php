<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Entrada;
use Illuminate\Support\Facades\DB;

class VentasChart extends ChartWidget
{
    protected ?string $heading = 'Ventas de Entradas';

    protected function getData(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;

        $ventasPorMes = array_fill(0, 12, 0);

        $query = Entrada::query()->where('status', 'vendido');

        // Aplicamos filtro de fecha solo si existen
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }


        $data = $query->select(
            DB::raw('COUNT(*) as total'),
            DB::raw('MONTH(created_at) as mes')
        )
        ->groupBy('mes')
        ->pluck('total','mes');

        foreach ($data as $mes => $total) 
        {
            // Aseguramos que el índice sea entero y restamos 1 para el array (0-11)
            $ventasPorMes[(int)$mes - 1] = $total;
        }

        return [
            //
            'datasets' => [
                [
                    'label' => 'Ventas totales',
                    'data' => $ventasPorMes,
                    'backgroudColor' => '#3b82f6',
                ],
            ],
            'labels' => ['Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic'],

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
