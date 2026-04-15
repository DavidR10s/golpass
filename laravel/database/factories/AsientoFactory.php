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
        return [
            //
            'n_asientos' => $this->faker->unique()->numberBetween('1','1000'),
            'sector' => $this->faker->randomElement(['Norte','Sur','Tribuna','Preferencia']),
            'status' => $this->faker->randomElement(['disponible','reservado','vendido']),
            'precio' => $this->faker->numberBetween(10,80),
            'partido_id' => Partido::factory(),
        ];
    }
}
