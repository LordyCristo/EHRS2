<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->lastName,
            'last_name' => $this->faker->lastName,
            'suffix' => $this->faker->suffix(),
            'birthdate' => $this->faker->date(),
            'age' => $this->faker->numberBetween(18, 60),
            'sex' => $this->faker->randomElement(['male','female']),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Widowed', 'Separated', 'Divorced']),
            'phone' => $this->faker->phoneNumber,
            'email_address' => $this->faker->email,
            'home_address'  => $this->faker->address,
            'curr_address' => $this->faker->address,
            'id_number' => function () {
                $year = rand(10, 23);
                $part1 = str_pad($year, 2, '0', STR_PAD_LEFT);
                $part2 = rand(1, 4); // Generate a random number between 1-4
                $part3 = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
                return "{$part1}-{$part2}-{$part3}";
            },
            'program_id' => $this->faker->numberBetween(1,49),
            'year_lvl' => $this->faker->numberBetween(1,6),
            'client_type_id' => $this->faker->numberBetween(1,4),
        ];
    }
}
