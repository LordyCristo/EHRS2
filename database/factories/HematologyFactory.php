<?php

namespace Database\Factories;

use App\Models\Hematology;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Hematology>
 */
class HematologyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hemoglobin' => $this->faker->randomFloat(1, 11, 22),
            'hematocrit' => $this->faker->randomFloat(2, 0.35, 0.54),
            'wbc' => $this->faker->randomFloat(1, 4, 22),
            'rbc' => $this->faker->randomFloat(1, 3.5, 7),
            'platelet_count' => $this->faker->randomFloat(0, 150, 450),
            'segmenters' => $this->faker->randomFloat(2, 0.5, 0.7),
            'lymphocyte' => $this->faker->randomFloat(2, 0.2, 0.4),
            'monocyte' => $this->faker->randomFloat(2, 0.01, 0.15),
            'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'remarks' => $this->faker->text(10),
        ];
    }
}
