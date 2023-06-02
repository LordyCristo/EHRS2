<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Payment;
use App\Models\Urinalysis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UrinalysisRecord>
 */
class UrinalysisRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $urinalysisIds = Urinalysis::pluck('id')->toArray();
        $clientIds = Client::pluck('infirmary_id')->toArray();
        $or_nos = Payment::pluck('or_no')->toArray();
        return [
            'urinalysis_id' => $this->faker->randomElement($urinalysisIds),
            'infirmary_id' => $this->faker->randomElement($clientIds),
            'age' => $this->faker->numberBetween(18,100),
            'sex' => $this->faker->randomElement(['male','female']),
            'ward' => $this->faker->randomElement(['OP','IN','ER','Ward']),
            'or_no' => $this->faker->randomElement($or_nos),
            'hospital_no' => 920283,
            'rqst_physician' => $this->faker->numberBetween(2,4),
            'medical_technologist' => $this->faker->numberBetween(2,4),
            'pathologist' => $this->faker->numberBetween(2,4),
            'status' => $this->faker->randomElement(['Pending','Released','Processing','Released','Done','Released','Cancelled','Released']),
            'remarks' => $this->faker->text(20),
        ];
    }
}
