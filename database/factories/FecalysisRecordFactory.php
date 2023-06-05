<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Fecalysis;
use App\Models\Payment;
use App\Models\PaymentsService;
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
        $clientIds = Payment::pluck('infirmary_id')->toArray();
        $or_nos = PaymentsService::pluck('payment_id')->toArray();
        return [
                // make the infirmary_id unique from the client_ids
                'infirmary_id' => function () use ($clientIds) {
                // get a random client_id
                $client_id = $this->faker->randomElement($clientIds);
                // remove the client_id from the array so it won't be used again
                $clientIds = array_diff($clientIds, [$client_id]);
                // return the client_id
                return $client_id;
            },
            'fecalysis_id' => function () use ($fecalysisIds) {
                // get a random fecalysis_id
                $fecalysis_id = $this->faker->randomElement($fecalysisIds);
                // remove the fecalysis_id from the array so it won't be used again
                $fecalysisIds = array_diff($fecalysisIds, [$fecalysis_id]);
                // return the fecalysis_id
                return $fecalysis_id;
            },
            'medical_technologist' => $this->faker->numberBetween(2, 4),
            'pathologist' => $this->faker->numberBetween(2, 4),
            'rqst_physician' => $this->faker->numberBetween(2, 4),
            'or_no' => function () use ($or_nos) {
                // get a random or_no
                $or_no = $this->faker->randomElement($or_nos);
                // remove the or_no from the array so it won't be used again
                $or_nos = array_diff($or_nos, [$or_no]);
                // return the or_no
                return $or_no;
            },
            'ward' => $this->faker->randomElement(['OPD','MALE WARD','ER','FEMALE WARD','PEDIA WARD','ISO-1','ISO-2']),
            'status' => $this->faker->randomElement(['pending','released']),
        ];
    }
}
