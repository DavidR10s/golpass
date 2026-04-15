<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\Estadio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partido>
 */
class PartidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*return [
            //
            'fecha'=> $this->faker->dateTimeBetween('now', '+2 months'),
            'finalizado'=> $this->faker->boolean(),
            'estadio_id' => Estadio::factory(),
            'equipo_local_id' => Equipo::factory(),
            'equipo_visitante_id' => Equipo::factory()
        ];*/
        return [
            'estadio_id' => Estadio::factory(),
            'equipo_local_id' => Equipo::factory(),
            'equipo_visitante_id' => Equipo::factory(),
            'fecha'=> $this->faker->dateTimeBetween('now', '+2 months'),
            'finalizado'=> $this->faker->boolean()
        ];
    }
}
