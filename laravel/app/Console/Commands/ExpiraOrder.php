<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Enums\StatusOrder;
use App\Enums\StatusAsiento;
use App\Enums\StatusEntrada;
use Illuminate\Support\Facades\DB;


class ExpiraOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expira:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Libera asientos de órdenes que no fueron pagadas en 15 minutos';

    /**
     * Execute the console command.
     */
    // App/Console/Commands/CleanupExpiredOrders.php

    public function handle()
    {
        $expiredOrders = Order::where('status', StatusOrder::PENDIENTE)
            ->where('expires_at', '<', now())
            ->with('entradas.asiento')
            ->get();

            if ($expiredOrders->isEmpty()) 
            {
                $this->info('No hay órdenes expiradas para procesar.');
                return;
            }

        foreach ($expiredOrders as $order) {

            $this->line("Procesando orden ID: {$order->id}...");
            // Transacción para asegurar integridad
            DB::transaction(function () use ($order) {
                foreach ($order->entradas as $entrada) {
                    // 1. Liberar el asiento
                    $entrada->asiento->update(['status' => StatusAsiento::DISPONIBLE]);

                    // 2. Cancelar la entrada
                    $entrada->update(['status' => StatusEntrada::CANCELADO]);
                }

                // 3. Marcar la orden como fallida/expirada
                $order->update(['status' => StatusOrder::EXPIRADA]);
            });
            $this->info("Orden {$order->id} expirada y asientos liberados.");
        }
    }
}
