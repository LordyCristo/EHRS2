<?php

namespace Database\Factories;

use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Services>
 */
class ServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'schedule' => $this->faker->sentence,
            'section_name' => $this->faker->word,
            'room_no' => $this->faker->word,
            'is_active' => true,
        ];
    }
}
