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
    }
}
