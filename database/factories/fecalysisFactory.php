<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fecalysis>
 */
class fecalysisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'color' => $this->faker->randomElement(["yellow", "brown", "green", "black", "red", "white", "gray", "orange", "blue", "purple", "pink", "other"]),
            'consistency' => $this->faker->randomElement(["soft", "hard", "watery", "sticky"]),
            'ova' => 'No Ova or parasites seen',
            'wbc' => $this->faker->randomFloat(2, 0, 2),
            'rbc' => $this->faker->randomFloat(2, 0, 2),
            'fat_globules' => $this->faker->randomFloat(2, 0, 2),
            'others' => $this->faker->sentence(3), // Generate an array of 3 words
            'remarks' => $this->faker->sentence(3), // Generate a random sentence
        ];
    }
}
