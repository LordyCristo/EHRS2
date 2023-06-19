<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'docyu@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'Elwin Jay',
            'middle_name' => 'B.',
            'last_name' => 'Yu',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 18,
            'role' => 1,
            'specialization' => 'Admin',
            'curr_position' => 'Admin',
            'license_no' => 1234,
            'telephone' => '1234567890',
            'mobile' => '1234567890',
        ]);
        $user->withoutApproval()->save();

        User::factory()->create([
            'email' => 'docguinocor@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'Merry Christ\'l',
            'middle_name' => 'T.',
            'last_name' => 'Guinocor',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 1,
            'specialization' => 'Medical Technologist',
            'curr_position' => 'Doctor',
            'license_no' => 1235,
            'telephone' => '1234567890',
            'mobile' => '1234567890',
        ]);

        User::factory()->create([
            'email' => 'doctabada@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'Sarah',
            'middle_name' => 'W.',
            'last_name' => 'Tabada',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 34,
            'role' => 1,
            'specialization' => 'Pathologist',
            'curr_position' => 'Doctor',
            'license_no' => 1238,
            'telephone' => '1234567890',
            'mobile' => '1234567890',
        ]);

        User::factory()->create([
            'email' => 'docbuson@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'Maria Belen',
            'middle_name' => 'J.',
            'last_name' => 'Buzon',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 1,
            'specialization' => 'Dentist',
            'curr_position' => 'Doctor',
            'license_no' => 1239,
            'telephone' => '1234567890',
            'mobile' => '1234567890',
        ]);

        //Laboratory
        User::factory()->create([
            'email' => 'laboratory@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'Laboratory',
            'middle_name' => 'L.',
            'last_name' => 'Laboratory',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 2,
            'specialization' => null,
            'curr_position' => 'Laboratory',
            'license_no' => 1236,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);

        //Cashier
        User::factory()->create([
            'email' => 'cashier@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'Cashier',
            'middle_name' => 'C.',
            'last_name' => 'Cashier',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 3,
            'specialization' => null,
            'curr_position' => 'Cashier',
            'license_no' => 1237,
            'telephone' => '1234567390',
            'mobile' => '1234567490',
        ]);

        //ER
        User::factory()->create([
            'email' => 'er@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'ER',
            'middle_name' => 'E.',
            'last_name' => 'ER',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 6,
            'specialization' => null,
            'curr_position' => 'ER',
            'license_no' => 12310,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);

        //radiology
        User::factory()->create([
            'email' => 'xray@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'Radiology',
            'middle_name' => 'E.',
            'last_name' => 'Radiology',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 4,
            'specialization' => null,
            'curr_position' => 'Radiology',
            'license_no' => 12311,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);

        //dental
        User::factory()->create([
            'email' => 'dental@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'Dental',
            'middle_name' => 'D.',
            'last_name' => 'Dental',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 5,
            'specialization' => null,
            'curr_position' => 'Dental',
            'license_no' => 12312,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);

        //Information Officer
        User::factory()->create([
            'email' => 'io@ehrs',
            'password' => Hash::make('password'),
            'first_name' => 'Information',
            'middle_name' => 'D.',
            'last_name' => 'Officer',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 7,
            'specialization' => null,
            'curr_position' => 'IO',
            'license_no' => 12313,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);
    }
}
