<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Department>
 */
class DepartmentFactory extends Factory
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
            'college_id' => $this->faker->numberBetween($min = 1, $max = 7),
            'is_active' => true,
        ];
    }

}
