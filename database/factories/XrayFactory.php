<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\XrayRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Xray>
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
        $rqstIds = XrayRequest::pluck('id')->toArray();
        $rad_tech_id = User::pluck('id')->toArray();
        $radiologist_id = User::pluck('id')->toArray();
        return [
            'rqst_id' => $this->faker->randomElement($rqstIds),
            'procedure' => $this->faker->word,
            'impression' => $this->faker->word,
            'radiographic_findings' => $this->faker->word,
            'rad_tech_id' => $this->faker->randomElement($rad_tech_id),
            'radiologist_id' => $this->faker->randomElement($radiologist_id),
        ];
    }
}
