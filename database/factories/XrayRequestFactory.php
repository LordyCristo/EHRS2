<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\PaymentsService;
use App\Models\User;
use App\Models\XrayRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<XrayRequest>
 */
class XrayRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clientIds = Client::pluck('infirmary_id')->toArray();
        $or_nos = PaymentsService::pluck('payment_id')->toArray();
        $rqst_physician = User::pluck('id')->toArray();
        return [
            'infirmary_id' => $this->faker->randomElement($clientIds),
            'or_no' => $this->faker->randomElement($or_nos),
            'rqst_for' => $this->faker->word,
            'history' => $this->faker->word,
            'rqst_physician' => $this->faker->randomElement($rqst_physician),
            'ward' => $this->faker->word,
            'status' => $this->faker->randomElement(['pending','released']),
        ];
    }
}
