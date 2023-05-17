<?php

namespace Database\Factories;

use App\Models\DegreeProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DegreeProgram>
 */
class DegreeProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->jobTitle,
            'abbr' => $this->faker->unique()->word,
            'major' => null,
            'group' => $this->faker->randomElement(['bach', 'master', 'doctor']),
            'department_id' => $this->faker->numberBetween($min = 1, $max = 35),
            'is_active' => true,
        ];
    }
}
