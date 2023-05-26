<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Fees;
use App\Models\Services;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payor_name' => $this->faker->name(),
            'payor_email' => $this->faker->email(),
            'payor_mobile' => $this->faker->phoneNumber(),
            'client_id' => $this->faker->numberBetween(1, 100),
            'service_id' => $this->faker->numberBetween(1, 8),
            'collector_id' => $this->faker->numberBetween(1, 4),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'remarks' => $this->faker->sentence(),
        ];
    }
}
