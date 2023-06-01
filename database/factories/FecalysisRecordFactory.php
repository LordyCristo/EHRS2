<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Fecalysis;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FecalysisRecord>
 */
class FecalysisRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecalysisIds = Fecalysis::pluck('id')->toArray();
        $clientIds = Client::pluck('infirmary_id')->toArray();
        $or_nos = Payment::pluck('or_no')->toArray();
        return [
            'fecalysis_id' => $this->faker->randomElement($fecalysisIds),
            'infirmary_id' => $this->faker->randomElement($clientIds),
            'age' => $this->faker->numberBetween(18, 90),
            'sex' => $this->faker->randomElement(['male','female']),
            'ward' => $this->faker->randomElement(['OP','IN','ER','Ward']),
            'or_no' => $this->faker->randomElement($or_nos),
            'hospital_no' => 920283,
            'rqst_physician' => $this->faker->numberBetween(2, 4),
            'medical_technologist' => $this->faker->numberBetween(2, 4),
            'pathologist' => $this->faker->numberBetween(2, 4),
            'status' => $this->faker->randomElement(['Pending','Released','Processing','Released','Done','Released','Cancelled','Released']),
        ];
    }
}
