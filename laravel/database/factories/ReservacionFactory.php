<?php

namespace Database\Factories;

use App\Models\Asiento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservacion>
 */
class ReservacionFactory extends Factory
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
            'asiento_id' => Asiento::factory(),
            'expira_en' => now()->addMinutes(15),
            'status' => $this->faker->randomElement(['activa', 'expirada', 'cancelada'])
        ];
    }
}
