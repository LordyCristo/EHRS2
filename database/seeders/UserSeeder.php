<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@localhost',
            'password' => Hash::make('password'),
            'first_name' => 'Admin',
            'middle_name' => 'Admin',
            'last_name' => 'Admin',
            'suffix' => 'Admin',
            'birthdate' => '2021-01-01',
            'age' => 18,
            'role' => 1,
            'specialization' => 'Admin',
            'curr_position' => 'Admin',
            'license_no' => 1234,
            'landline' => '1234567890',
            'mobile' => '1234567890',
        ]);

        User::factory()->create([
            'email' => 'mariekrismoron@localhost',
            'password' => Hash::make('password'),
            'first_name' => 'Marie Kris',
            'middle_name' => 'C.',
            'last_name' => 'Moron',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 2,
            'specialization' => 'Medical Technologist',
            'curr_position' => 'Doctor',
            'license_no' => '0056874',
            'landline' => '1234567890',
            'mobile' => '1234567890',
        ]);

        User::factory()->create([
            'email' => 'cleocitaportula@localhost',
            'password' => Hash::make('password'),
            'first_name' => 'Cleocita',
            'middle_name' => 'P.',
            'last_name' => 'Portula',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 34,
            'role' => 2,
            'specialization' => 'Pathologist',
            'curr_position' => 'Doctor',
            'license_no' => '0094389',
            'landline' => '1234567890',
            'mobile' => '1234567890',
        ]);

        User::factory()->create([
            'email' => 'gayfernandez@localhost',
            'password' => Hash::make('password'),
            'first_name' => 'Gay',
            'middle_name' => 'S.',
            'last_name' => 'Fernandez',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 2,
            'specialization' => 'Medical Technologist',
            'curr_position' => 'Doctor',
            'license_no' => '0019049',
            'landline' => '1234567890',
            'mobile' => '1234567890',
        ]);
    }
}
