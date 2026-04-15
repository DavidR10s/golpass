<?php

namespace Database\Seeders;

use App\Models\Asiento;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Partido;
use App\Models\Entrada;
use App\Models\Estadio;
use App\Models\Order;
use App\Models\Pago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str as Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $usuarios = User::factory(10)->create();

        User::factory()->admin()->create([
            'name' => 'admin',
            'email' => 'admin@golpass.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        $estadios = Estadio::factory(5)
        ->create();

        $equipos = Equipo::factory(10)
        ->recycle($estadios)
        ->create();

        $partidos = Partido::factory(20)
        ->recycle($equipos)
        ->recycle($estadios)
        ->create();

        foreach ($partidos as $partido) {
            $asientos = Asiento::factory(50)->create([
                'partido_id' => $partido->id,
            ]);
        }

        // 6. Órdenes y Entradas (El flujo de venta final)
        // Aquí simulamos ventas reales para tener datos en el sistema
        Order::factory(20)->recycle($usuarios)->create()->each(function ($order) use ($partidos) {
            // Seleccionamos un partido al azar
            $partido = $partidos->random();
            
            // Buscamos un asiento disponible para ese partido
            $asiento = Asiento::where('partido_id', $partido->id)
                           ->where('status', 'disponible')
                           ->first();

            if ($asiento) {
                // Creamos la Entrada (Ticket) vinculada a la orden y al asiento
                Entrada::factory()->create([
                    'order_id'      => $order->id,
                    'asiento_id'    => $asiento->id,
                    'partido_id'    => $partido->id,
                    'precio_final'  => $partido->precio_base, // Precio del ticket = precio del partido
                    'codigo_qr'     => Str::uuid(), // Generamos un código QR único para la entrada
                ]);

                // Actualizamos el estado del asiento a 'vendido'
                $asiento->update(['status' => 'vendido']);

                // 7. Generamos el Pago de esa Orden si está pagada
                if ($order->status === 'completado') {
                    Pago::factory()->create([
                        'order_id' => $order->id,
                    ]);
                }
            }
        });

    }
}
