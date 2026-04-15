<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'user_id' => User::factory(),
            'numero_pedido' => $this->faker->unique()->numerify('ORD-#####'),
            'cantidad' => $this->faker->numberBetween(1, 5),
            'total' => $this->faker->randomFloat(2, 10, 100),
            'status' => $this->faker->randomElement(['pendiente', 'completado', 'fallido']),

        ];
    }
}
