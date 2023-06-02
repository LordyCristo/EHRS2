<?php

namespace Database\Factories;

use App\Models\Fees;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $paymentIds = Payment::pluck('id')->toArray();
        $serviceIds = Fees::pluck('service_id')->toArray();
        return [
            'payment_id' => $this->faker->randomElement($paymentIds),
            'service_id' => $this->faker->randomElement($serviceIds),
            'fee' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
