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
            'email' => 'admin@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Cristo Rey',
            'middle_name' => 'Ceniza',
            'last_name' => 'Magdadaro',
            'suffix' => null,
            'birthdate' => '2000-11-22',
            'age' => 22,
            'role' => 1,
            'specialization' => 'Admin',
            'curr_position' => 'Admin',
            'license_no' => 1230,
            'telephone' => '1234567890',
            'mobile' => '1234567890',
        ]);
        $user->withoutApproval()->save();

        $user = User::factory()->create([
            'email' => 'docyu@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Elwin Jay',
            'middle_name' => 'B.',
            'last_name' => 'Yu',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 18,
            'role' => 2,
            'specialization' => 'Admin',
            'curr_position' => 'Admin',
            'license_no' => 1234,
            'telephone' => '1234567890',
            'mobile' => '1234567890',
        ]);
        $user->withoutApproval()->save();

        $user = User::factory()->create([
            'email' => 'docguinocor@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Merry Christ\'l',
            'middle_name' => 'T.',
            'last_name' => 'Guinocor',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 2,
            'specialization' => 'Medical Technologist',
            'curr_position' => 'Doctor',
            'license_no' => 1235,
            'telephone' => '1234567890',
            'mobile' => '1234567890',
        ]);
        $user->withoutApproval()->save();

        $user = User::factory()->create([
            'email' => 'doctabada@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Sarah',
            'middle_name' => 'W.',
            'last_name' => 'Tabada',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 34,
            'role' => 2,
            'specialization' => 'Pathologist',
            'curr_position' => 'Doctor',
            'license_no' => 1238,
            'telephone' => '1234567890',
            'mobile' => '1234567890',
        ]);
        $user->withoutApproval()->save();

        $user = User::factory()->create([
            'email' => 'docbuson@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Maria Belen',
            'middle_name' => 'J.',
            'last_name' => 'Buzon',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 2,
            'specialization' => 'Dentist',
            'curr_position' => 'Doctor',
            'license_no' => 1239,
            'telephone' => '1234567890',
            'mobile' => '1234567890',
        ]);
        $user->withoutApproval()->save();

        //Laboratory
        $user = User::factory()->create([
            'email' => 'laboratory@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Laboratory',
            'middle_name' => 'L.',
            'last_name' => 'Laboratory',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 5,
            'specialization' => null,
            'curr_position' => 'Laboratory',
            'license_no' => 1236,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);
        $user->withoutApproval()->save();

        //Cashier
        $user = User::factory()->create([
            'email' => 'cashier@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Cashier',
            'middle_name' => 'C.',
            'last_name' => 'Cashier',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 9,
            'specialization' => null,
            'curr_position' => 'Cashier',
            'license_no' => 1237,
            'telephone' => '1234567390',
            'mobile' => '1234567490',
        ]);
        $user->withoutApproval()->save();

        //radiology
        $user = User::factory()->create([
            'email' => 'xray@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Radiology',
            'middle_name' => 'E.',
            'last_name' => 'Radiology',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 6,
            'specialization' => null,
            'curr_position' => 'Radiology',
            'license_no' => 12311,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);
        $user->withoutApproval()->save();

        //dental
        $user = User::factory()->create([
            'email' => 'dental@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Dental',
            'middle_name' => 'D.',
            'last_name' => 'Dental',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 3,
            'specialization' => null,
            'curr_position' => 'Dental',
            'license_no' => 12312,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);
        $user->withoutApproval()->save();

        //Information Officer
        $user = User::factory()->create([
            'email' => 'io@ehrs.com',
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
        $user->withoutApproval()->save();

        //Nurse
        $user = User::factory()->create([
            'email' => 'nurse@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Nurse',
            'middle_name' => 'D.',
            'last_name' => 'Officer',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 4,
            'specialization' => null,
            'curr_position' => 'Nurse',
            'license_no' => 123112,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);
        $user->withoutApproval()->save();

        //Records Officer
        $user = User::factory()->create([
            'email' => 'records@ehrs.com',
            'password' => Hash::make('password'),
            'first_name' => 'Records',
            'middle_name' => 'D.',
            'last_name' => 'Officer',
            'suffix' => null,
            'birthdate' => '2021-01-01',
            'age' => 25,
            'role' => 8,
            'specialization' => null,
            'curr_position' => 'Records Officer',
            'license_no' => 123114,
            'telephone' => '12343567390',
            'mobile' => '12345673490',
        ]);
        $user->withoutApproval()->save();
    }
}
