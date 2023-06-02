<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Urinalysis>
 */
class UrinalysisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // start
            'color' => $this->faker->randomElement(["yellow", "brown", "green", "black", "red", "white", "gray", "orange", "blue", "purple", "pink", "other"]),
            'clarity' => $this->faker->randomElement(["clear", "slightly_turbid", "turbid", "other"]),
            'ph' => $this->faker->randomFloat(1, 0, 10),
            'specific_gravity' => $this->faker->randomFloat(1, 0, 10),
            'albumin' => $this->faker->randomElement(["negative", "trace", "1+", "2+", "3+", "4+", "other"]),
            'glucose' => $this->faker->randomElement(["negative", "trace", "1+", "2+", "3+", "4+", "other"]),
            'blood' => $this->faker->randomElement(["negative", "trace", "1+", "2+", "3+", "4+", "other"]),
            'leukocytes' => $this->faker->randomElement(["negative", "trace", "1+", "2+", "3+", "4+", "other"]),
            'nitrite' => $this->faker->randomElement(["negative", "positive", "other"]),
            'bilirubin' => $this->faker->randomElement(["negative", "trace", "1+", "2+", "3+", "4+", "other"]),
            'urobilinogen' => $this->faker->randomElement(["negative", "trace", "1+", "2+", "3+", "4+", "other"]),
            'ketones' => $this->faker->randomElement(["negative", "trace", "1+", "2+", "3+", "4+", "other"]),
            'wbc' => $this->faker->randomFloat(2, 0, 2),
            'rbc' => $this->faker->randomFloat(2, 0, 2),
            'epithelial_cells' => $this->faker->randomElement(["few", "moderate", "many", "other"]),
            'bacteria' => $this->faker->randomElement(["few", "moderate", "many", "other"]),
            'amorphous_urates' => $this->faker->randomElement(["few", "moderate", "many", "other"]),
            'amorphous_phosphates' => $this->faker->randomElement(["few", "moderate", "many", "other"]),
            'mucous_threads' => $this->faker->randomElement(["few", "moderate", "many", "other"]),
            'crystals' => $this->faker->randomElement(["few", "moderate", "many", "other"]),
            'cast' => $this->faker->randomElement(["few", "moderate", "many", "other"]),
            'remarks' => $this->faker->sentence(), // Generate a random sentence
        ];
    }
}
