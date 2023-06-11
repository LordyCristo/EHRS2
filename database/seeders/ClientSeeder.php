<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory()->create([
            'infirmary_id' => '1633',
            'first_name' => 'Cristo Rey',
            'middle_name' => 'Ceniza',
            'last_name' => 'Magdadaro',
            'suffix' => null,
            'birthdate' => '2000-11-22',
            'age' => 22,
            'sex' => 'male',
            'religion' => 'roman catholic',
            'nationality' => 'filipino',
            'civil_status' => 'single',
            'phone' => '09127092422',
            'email_address' => '19-1-00255@vsu.edu.ph',
            'home_address'  => 'Ormoc City, Leyte',
            'curr_address' => 'Visca, Baybay City, Leyte',
            'employer' => 'Visayas State University',
            'id_number' => '19-1-00255',
            'program_id' => 25,
            'year_lvl' => 4,
            'client_type_id' => 1,
        ]);
        Client::factory(100)->create();
    }
}
