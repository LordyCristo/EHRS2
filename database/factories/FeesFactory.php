<?php

namespace Database\Factories;

use App\Models\ClientType;
use App\Models\Fees;
use App\Models\Services;
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
        $services = Services::pluck('id')->toArray();
        $clientTypes = ClientType::pluck('id')->toArray();
        return [
            'service_id' => $this->faker->randomElement($services),
            'client_type' => $this->faker->randomElement($clientTypes),
            'amount' => $this->faker->numberBetween(1000, 4000),
        ];
    }
}
