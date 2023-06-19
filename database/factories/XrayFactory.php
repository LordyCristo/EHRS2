<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Xray;
use App\Models\XrayRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Xray>
 */
class XrayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rad_tech_id = User::pluck('id')->toArray();
        $radiologist_id = User::pluck('id')->toArray();
        return [
            'rqst_id' => XrayRequest::factory()->create()->id,
            'procedure' => $this->faker->word,
            'impression' => $this->faker->word,
            'radiographic_findings' => $this->faker->word,
            'rad_tech_id' => $this->faker->randomElement($rad_tech_id),
            'radiologist_id' => $this->faker->randomElement($radiologist_id),
        ];
    }
}
