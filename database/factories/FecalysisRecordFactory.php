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
            'infirmary_id' => $this->faker->randomElement($clientIds),
            'fecalysis_id' => $this->faker->randomElement($fecalysisIds),
            'medical_technologist' => $this->faker->numberBetween(2, 4),
            'pathologist' => $this->faker->numberBetween(2, 4),
            'rqst_physician' => $this->faker->numberBetween(2, 4),
            'or_no' => $this->faker->randomElement($or_nos),
            'ward' => $this->faker->randomElement(['OPD','MALE WARD','ER','FEMALE WARD','PEDIA WARD','ISO-1','ISO-2']),
            'status' => $this->faker->randomElement(['pending','released']),
        ];
    }
}
