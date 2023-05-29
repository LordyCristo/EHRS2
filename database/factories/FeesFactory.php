<?php

namespace Database\Factories;

use App\Models\Fees;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Fees>
 */
class FeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_id' => $this->faker->numberBetween(1, 8),
            'client_type' => $this->faker->numberBetween(1, 4),
            'amount' => $this->faker->numberBetween(1000, 4000),
        ];
    }
}
