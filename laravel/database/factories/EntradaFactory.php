<?php

namespace Database\Factories;

use App\Models\Asiento;
use App\Models\Order;
use App\Models\Partido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entrada>
 */
class EntradaFactory extends Factory
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
            'status' => $this->faker->randomElement(['disponible','reservado','vendido']),
            'precio_final' => $this->faker->numberBetween(10,80),
            'order_id' => Order::factory(),
            'asiento_id' => Asiento::factory(),
            'partido_id' => Partido::factory(),
        ];
    }
}
