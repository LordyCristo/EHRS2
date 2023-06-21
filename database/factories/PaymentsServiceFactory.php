<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Fees;
use App\Models\Model;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class PaymentsServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $serviceIds = Fees::pluck('service_id')->toArray();
        $rand = $this->faker->randomElement($serviceIds);
        $rand_fee = Fees::where('service_id', $rand)->first()->amount;
        return [
            'payment_id' => Payment::factory()->create(
                [
                    'infirmary_id' => $this->faker->randomElement(Client::pluck('infirmary_id')->toArray()),
                    'collector_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
                    'total_amount' => $rand_fee,
                ]
            )->or_no,
            'service_id' => $rand,
            'fee' => $rand_fee,
            'created_at' => $this->faker->dateTimeBetween('-3 year', 'now'),
        ];
    }
}
