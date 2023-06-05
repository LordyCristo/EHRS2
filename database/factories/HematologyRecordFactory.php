<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Hematology;
use App\Models\HematologyRecord;
use App\Models\Payment;
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
        $hematologyIds = Hematology::pluck('id')->toArray();
        $clientIds = Client::pluck('infirmary_id')->toArray();
        $or_nos = Payment::pluck('or_no')->toArray();
        return [
            'infirmary_id' => $this->faker->randomElement($clientIds),
            'hematology_id' => $this->faker->randomElement($hematologyIds),
            'rqst_physician' => $this->faker->numberBetween(2,4),
            'medical_technologist' => $this->faker->numberBetween(2,4),
            'pathologist' => $this->faker->numberBetween(2,4),
            'or_no' => $this->faker->randomElement($or_nos),
            'ward' => $this->faker->randomElement(['OPD','IN','ER','Ward']),
            'status' => $this->faker->randomElement(['pending','released']),
        ];
    }
}
