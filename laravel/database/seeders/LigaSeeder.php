<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\Estadio;
use App\Models\Partido;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LigaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Generar Estadios
        $datosEstadios = [
            ['nombre' => 'Santiago Bernabéu', 'ciudad' => 'Madrid', 'capacidad' => 81044],
            ['nombre' => 'Spotify Camp Nou', 'ciudad' => 'Barcelona', 'capacidad' => 99354],
            ['nombre' => 'Metropolitano', 'ciudad' => 'Madrid', 'capacidad' => 68456],
            ['nombre' => 'Sánchez-Pizjuán', 'ciudad' => 'Sevilla', 'capacidad' => 43883],
            ['nombre' => 'San Mamés', 'ciudad' => 'Bilbao', 'capacidad' => 53289],
        ];

        foreach ($datosEstadios as $estadio) {
            Estadio::create($estadio);
        }

        // 2. Generar Equipos
        $datosEquipos = [
            ['nombre' => 'Real Madrid', 'localidad' => 'Madrid', 'logo_url' => 'img/equipos/real_madrig.png'],
            ['nombre' => 'FC Barcelona', 'localidad' => 'Catalonia', 'logo_url' => 'img/equipos/barcelona.png'],
            ['nombre' => 'Atlético de Madrid', 'localidad' => 'Madrid', 'logo_url' => 'img/equipos/atletico_madrid.png'],
            ['nombre' => 'Sevilla FC', 'localidad' => 'Sevilla', 'logo_url' => 'img/equipos/sevilla.webp'],
            ['nombre' => 'Athletic Club', 'localidad' => 'Bilbao', 'logo_url' => 'img/equipos/athletic_club.png'],
            ['nombre' => 'Girona', 'localidad' => 'Catalonia', 'logo_url' => 'img/equipos/girona.webp'],
            ['nombre' => 'Rayo Vallecano', 'localidad' => 'Madrid', 'logo_url' => 'img/equipos/rayo_vallecano.webp'],
            ['nombre' => 'Real Betis', 'localidad' => 'Sevilla', 'logo_url' => 'img/equipos/real_betis.webp'],
            ['nombre' => 'Valencia', 'localidad' => 'Valencia', 'logo_url' => 'img/equipos/valencia.webp'],
            ['nombre' => 'Getafe FC', 'localidad' => 'Madrid', 'logo_url' => 'img/equipos/getafe.webp'],
            ['nombre' => 'Deportivo Alavés', 'localidad' => 'Vitoria', 'logo_url' => 'img/equipos/alaves.webp'],
            ['nombre' => 'Villareal FC', 'localidad' => 'Valencia', 'logo_url' => 'img/equipos/villareal.png'],
            ['nombre' => 'Osasuna', 'localidad' => 'Pamplona', 'logo_url' => 'img/equipos/osasuna.webp'],
            ['nombre' => 'Levante', 'localidad' => 'Valencia', 'logo_url' => 'img/equipos/levante.webp'],
            ['nombre' => 'Espanyol', 'localidad' => 'Catalonia', 'logo_url' => 'img/equipos/espanyol.webp'],
            ['nombre' => 'Real Sociedad', 'localidad' => 'San Sebastian', 'logo_url' => 'img/equipos/real_sociedad.webp'],
            ['nombre' => 'Celta Vigo', 'localidad' => 'Vigo', 'logo_url' => 'img/equipos/celta.webp'],
        ];

        foreach ($datosEquipos as $equipo) {
            Equipo::create($equipo);
        }

        // 3. Generar Partidos
        // Obtenemos colecciones para asignar IDs dinámicamente
        $estadios = Estadio::all();
        $equipos = Equipo::all();

        $partidos = [
            [
                'estadio_id' => $estadios->where('nombre', 'Santiago Bernabéu')->first()->id,
                'equipo_local_id' => $equipos->where('nombre', 'Real Madrid')->first()->id,
                'equipo_visitante_id' => $equipos->where('nombre', 'FC Barcelona')->first()->id,
                'precio_base' => 90.00,
                'fecha' => Carbon::now()->addDays(10),
                'finalizado' => false,
            ],
            [
                'estadio_id' => $estadios->where('nombre', 'Metropolitano')->first()->id,
                'equipo_local_id' => $equipos->where('nombre', 'Atlético de Madrid')->first()->id,
                'equipo_visitante_id' => $equipos->where('nombre' , 'Sevilla FC')->first()->id,
                'precio_base' => 50.50,
                'fecha' => Carbon::now()->subDays(2),
                'finalizado' => true,
            ],
            [
                'estadio_id' => $estadios->where('nombre', 'San Mamés')->first()->id,
                'equipo_local_id' => $equipos->where('nombre', 'Athletic Club')->first()->id,
                'equipo_visitante_id' => $equipos->where('nombre', 'Real Madrid')->first()->id,
                'precio_base' => 65.00,
                'fecha' => Carbon::now()->addWeeks(2),
                'finalizado' => false,
            ],
        ];

        foreach ($partidos as $partido) {
            Partido::create($partido);
        }
    }
}