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
            'hemoglobin' => $this->faker->randomFloat(2, 0, 5),
            'hematocrit' => $this->faker->randomFloat(2, 0, 5),
            'wbc' => $this->faker->randomFloat(2, 0, 5),
            'rbc' => $this->faker->randomFloat(2, 0, 5),
            'platelet_count' => $this->faker->randomFloat(2, 0, 5),
            'segmenters' => $this->faker->randomFloat(2, 0, 5),
            'lymphocyte' => $this->faker->randomFloat(2, 0, 5),
            'monocyte' => $this->faker->randomFloat(2, 0, 5),
            'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'diagnosis' => $this->faker->text(100),
            'remarks' => $this->faker->text(100),
            'status' => $this->faker->randomElement(['Pending','Released','Processing','Released','Done','Released','Cancelled','Released']),
        ];
    }
}
