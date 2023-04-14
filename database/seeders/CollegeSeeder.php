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
            'abbreviation' => 'CAFS',
            'is_active' => true,
        ]);

        College::factory()->create([
            'id' => 2 ,
            'name' => 'College of Education',
            'abbreviation' => 'CoEd',
            'is_active' => true,
        ]);

        College::factory()->create([
            'id' => 3 ,
            'name' => 'College of Engineering and Technology',
            'abbreviation' => 'CET',
            'is_active' => true,
        ]);

        College::factory()->create([
            'id' => 4 ,
            'name' => 'College of Arts and Sciences',
            'abbreviation' => 'CAS',
            'is_active' => true,
        ]);

        College::factory()->create([
            'id' => 5 ,
            'name' => 'College of Veterinary Medicine',
            'abbreviation' => 'CVM',
            'is_active' => true,
        ]);

        College::factory()->create([
            'id' => 6 ,
            'name' => 'College of Nursing',
            'abbreviation' => 'CoN',
            'is_active' => true,
        ]);

        College::factory()->create([
            'id' => 7 ,
            'name' => 'College of Management and Economics',
            'abbreviation' => 'CME',
            'is_active' => true,
        ]);

        College::factory()->create([
            'id' =>  8,
            'name' => 'College of Forestry and Environmental Science',
            'abbreviation' => 'CFES',
            'is_active' => true,
        ]);
    }
}
