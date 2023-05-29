<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\College;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        College::factory()->create([
            'id' => 1 ,
            'name' => 'College of Agriculture and Food Science',
            'abbr' => 'CAFS',
        ]);

        College::factory()->create([
            'id' => 2 ,
            'name' => 'College of Education',
            'abbr' => 'CoEd',
        ]);

        College::factory()->create([
            'id' => 3 ,
            'name' => 'College of Engineering and Technology',
            'abbr' => 'CET',
        ]);

        College::factory()->create([
            'id' => 4 ,
            'name' => 'College of Arts and Sciences',
            'abbr' => 'CAS',
        ]);

        College::factory()->create([
            'id' => 5 ,
            'name' => 'College of Veterinary Medicine',
            'abbr' => 'CVM',
        ]);

        College::factory()->create([
            'id' => 6 ,
            'name' => 'College of Nursing',
            'abbr' => 'CoN',
        ]);

        College::factory()->create([
            'id' => 7 ,
            'name' => 'College of Management and Economics',
            'abbr' => 'CME',
        ]);

        College::factory()->create([
            'id' =>  8,
            'name' => 'College of Forestry and Environmental Science',
            'abbr' => 'CFES',
        ]);
    }
}
