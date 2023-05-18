<?php

namespace Database\Factories;

use App\Models\HematologyRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HematologyRecord>
 */
class HematologyRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->numberBetween(1, 100),
            'client_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}
