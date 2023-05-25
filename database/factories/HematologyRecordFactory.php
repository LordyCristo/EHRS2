<?php

namespace Database\Factories;

use App\Models\Hematology;
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
            'id' => Hematology::factory(),
            'client_id' => $this->faker->numberBetween(1, 100),
            'age' => $this->faker->numberBetween(18, 100),
            'sex' => $this->faker->randomElement(['male','female']),
            'ward' => $this->faker->word(),
            'or_no' => $this->faker->randomNumber(5),
            'rqst_physician' => $this->faker->numberBetween(2,4),
            'hospital_no' => '920283',
        ];
    }
}
