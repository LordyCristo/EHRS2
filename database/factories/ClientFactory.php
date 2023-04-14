<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
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
            'id_number' => $this->faker->unique()->randomNumber(8),
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->lastName,
            'last_name' => $this->faker->lastName,
            'suffix' => $this->faker->randomElement(['','Jr.','','Sr.','','III','','I','','II']),
            'birthdate' => $this->faker->date(),
            'age' => $this->faker->numberBetween($min = 18, $max = 60),
            'sex' => $this->faker->randomElement(['MALE','FEMALE']),
            'blood_type' => $this->faker->randomElement(['A+','A-','B+','B-','AB+','AB-','O+','O-', null]),
            'civil_status' => $this->faker->randomElement(['SINGLE','MARRIED','WIDOWED','SEPARATED','DIVORCED']),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'home_address' => $this->faker->address,
            'curr_address' => $this->faker->address,
            'degree_program_id' => $this->faker->numberBetween($min = 1, $max = 49),
            'year_level' => $this->faker->randomElement(['1st','2nd','3rd','4th','5th','6th']),
            'department_id' => $this->faker->numberBetween($min = 1, $max = 35),
            'client_type_id' => $this->faker->numberBetween($min = 1, $max = 4)
        ];
    }
}
