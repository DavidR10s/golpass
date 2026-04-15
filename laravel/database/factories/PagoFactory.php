<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pago>
 */
class PagoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'metodo_pago' => $this->faker->randomElement(['stripe', 'paypal', 'credit_card']),
            'transaction_id' => 'TXN-' . strtoupper($this->faker->bothify('??###?###')),
            'status' => 'success',
            // Pasamos un array directamente. 
            // Laravel lo convertirá a JSON si el modelo tiene el cast 'array'
            'payload_completo' => [
                'ip_address' => $this->faker->ipv4,
                'user_agent' => $this->faker->userAgent,
                'auth_code'  => $this->faker->numerify('######')
            ],
        ];
    }
}
