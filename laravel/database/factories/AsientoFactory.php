<?php

namespace Database\Factories;

use App\Models\Partido;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asiento>
 */
class AsientoFactory extends Factory
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
            
            'sector' => $this->faker->randomElement(['Norte','Sur','Tribuna','Preferencia']),
            'status' => $this->faker->randomElement(['disponible','reservado','vendido']),
            'partido_id' => Partido::factory(),
        ];*/
        return [
            'fila' => $this->faker->bothify('Fila ##'),
            'numero' => $this->faker->numberBetween(1, 1000),
            'sector' => $this->faker->randomElement(['Norte','Sur','Tribuna','Preferencia']),
            'status' => $this->faker->randomElement(['disponible','reservado','vendido']),
            'partido_id' => Partido::factory(),
        ];
    }
}
