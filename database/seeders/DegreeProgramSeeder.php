<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DegreeProgram;

class DegreeProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //College of Agriculture and Food Science
        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbreviation' => 'BSA-AEE',
            'major' => 'Agricultural Education and Extension',
            'department_id' => 1,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbreviation' => 'BSA-AGR',
            'major' => 'Agronomy',
            'department_id' => 2,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbreviation' => 'BSA-AnSci',
            'major' => 'Animal Science',
            'department_id' => 3,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Development Communication',
            'abbreviation' => 'BDC',
            'department_id' => 4,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbreviation' => 'BSA-FST',
            'major' => 'Food Science and Technology',
            'department_id' => 5,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbreviation' => 'BSA-HOR',
            'major' => 'Horticulture',
            'department_id' => 6,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbreviation' => 'BSA-PM',
            'major' => 'Pest Management',
            'department_id' => 7,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbreviation' => 'BSA-PBG',
            'major' => 'Plant Breeding and Genetics',
            'department_id' => 8,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbreviation' => 'BSA-PP',
            'major' => 'Plant Pathology',
            'department_id' => 9,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbreviation' => 'BSA-AE',
            'major' => 'Agricultural Economics ',
            'department_id' => 9,
            'is_active' => true,
        ]);

        // College of Education
        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Elementary Education',
            'abbreviation' => 'BEED-PSE',
            'major' => 'Pre-School Education',
            'department_id' => 10,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Elementary Education',
            'abbreviation' => 'BEED-GE',
            'major' => 'General Education',
            'department_id' => 10,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbreviation' => 'BEED-BS',
            'major' => 'Biological Sciences',
            'department_id' => 10,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbreviation' => 'BEED-SS',
            'major' => 'Social Studies',
            'department_id' => 10,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbreviation' => 'BEED-MATH',
            'major' => 'Mathematics',
            'department_id' => 10,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbreviation' => 'BEED-PS',
            'major' => 'Physical Sciences',
            'department_id' => 10,
            'is_active' => true,
        ]);


        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbreviation' => 'BEED-FIL',
            'major' => 'Filipino',
            'department_id' => 10,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Culture and Arts Education',
            'abbreviation' => 'BCAED',
            'major' => null,
            'department_id' => 11,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Physical Education',
            'abbreviation' => 'BPED',
            'major' => null,
            'department_id' => 11,
            'is_active' => true,
        ]);


        // College of Engineering and Technology
        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agricultural and Biosystems Engineering',
            'abbreviation' => 'BSABE',
            'major' => null,
            'department_id' => 14,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Civil Engineering',
            'abbreviation' => 'BSCE-SE',
            'major' => 'Structural Engineering',
            'department_id' => 15,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Civil Engineering',
            'abbreviation' => 'BSCE-CE',
            'major' => 'Construction Engineering',
            'department_id' => 15,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Civil Engineering',
            'abbreviation' => 'BSCE-EE',
            'major' => 'Environmental Engineering',
            'department_id' => 15,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Civil Engineering',
            'abbreviation' => 'BSCE-WE',
            'major' => 'Water Resources Engineering',
            'department_id' => 15,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Computer Science',
            'abbreviation' => 'BSCS',
            'department_id' => 16,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Geodetic Engineering',
            'abbreviation' => 'BSGE',
            'department_id' => 17,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Mechanical Engineering',
            'abbreviation' => 'BSME',
            'department_id' => 18,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Meteorology',
            'abbreviation' => 'BSMET',
            'department_id' => 19,
            'is_active' => true,
        ]);

        //College of
        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Biology',
            'abbreviation' => 'BSBio',
            'department_id' => 20,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Biotechnology',
            'abbreviation' => 'BSBioTech',
            'department_id' => 25,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Chemistry',
            'abbreviation' => 'BSChem',
            'department_id' => 24,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Applied Physics',
            'abbreviation' => 'BSAP',
            'department_id' => 22,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Arts in English Language Studies',
            'abbreviation' => 'BAELS',
            'department_id' => 21,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Arts in Philosophy',
            'abbreviation' => 'BSPhilo',
            'department_id' => 21,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Statistics',
            'abbreviation' => 'BSStat',
            'department_id' => 23,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Mathematics',
            'abbreviation' => 'BSMath',
            'department_id' => 22,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Doctor of Veterinary Medicine',
            'abbreviation' => 'DVM-BVM',
            'major' => 'Basic Veterinary Medicine',
            'department_id' => 26,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Doctor of Veterinary Medicine',
            'abbreviation' => 'DVM-VCS',
            'major' => 'Veterinary Clinical Sciences',
            'department_id' => 27,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Doctor of Veterinary Medicine',
            'abbreviation' => 'DVM',
            'major' => 'Veterinary Para-Clinical Sciences',
            'department_id' => 28,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Economics',
            'abbreviation' => 'BSEcon',
            'department_id' => 32,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Nursing',
            'abbreviation' => 'BSN',
            'department_id' => 29,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Tourism Management',
            'abbreviation' => 'BSTM',
            'department_id' => 31,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Hospitality Management',
            'abbreviation' => 'BSHM',
            'department_id' => 31,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Accountancy',
            'abbreviation' => 'BSA',
            'department_id' => 30,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agribusiness',
            'abbreviation' => 'BSAgriB',
            'department_id' => 30,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Forestry',
            'abbreviation' => 'BSF',
            'department_id' => 34,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Environmental Science',
            'abbreviation' => 'BSES',
            'department_id' => 20,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Marine Biology',
            'abbreviation' => 'MSMB',
            'department_id' => 20,
            'is_active' => true,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Food Technology',
            'abbreviation' => 'BSFT',
            'department_id' => 25,
            'is_active' => true,
        ]);
    }
}
