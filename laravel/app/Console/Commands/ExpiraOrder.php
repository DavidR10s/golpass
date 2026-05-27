<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Enums\StatusOrder;
use App\Enums\StatusAsiento;
use App\Enums\StatusEntrada;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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
        $ahora = now();
        $this->info("Hora actual: " . $ahora->toDateTimeString());

        // Obtenemos las órdenes pendientes
        $ordenes = Order::where('status', StatusOrder::PENDIENTE)->get();

        if ($ordenes->isEmpty()) {
            $this->warn("No hay órdenes pendientes en la base de datos.");
            return;
        }

        foreach ($ordenes as $order) {
            // Si expires_at llega como string por algún error de configuración, lo convertimos a Carbon
            $fechaExpiracion = $order->expires_at ? Carbon::parse($order->expires_at) : null;

            if (!$fechaExpiracion) {
                $this->error("Orden ID: {$order->id} - Tiene fecha NULL en la base de datos.");
                continue;
            }

            $this->line("Orden ID: {$order->id} | Expira: " . $fechaExpiracion->toDateTimeString());

            if ($fechaExpiracion->lt($ahora)) {
                $this->info("--> EXPIRADA. Procesando liberación...");

                DB::transaction(function () use ($order) {
                    foreach ($order->entradas as $entrada) {
                        $entrada->asiento->update(['status' => StatusAsiento::DISPONIBLE]);
                        $entrada->update(['status' => StatusEntrada::CANCELADO]);
                    }
                    $order->update(['status' => StatusOrder::EXPIRADA]);
                });

                $this->info("--> Éxito: Orden {$order->id} expirada.");
            } else {
                $this->comment("--> Aún vigente. Faltan " . $ahora->diffInMinutes($fechaExpiracion) . " minutos.");
            }
        }
    }
}
