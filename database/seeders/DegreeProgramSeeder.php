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
            'abbr' => 'BSA-AEE',
            'major' => 'Agricultural Education and Extension',
            'group' => 'bachelor',
            'department_id' => 1,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbr' => 'BSA-AGR',
            'major' => 'Agronomy',
            'group' => 'bachelor',
            'department_id' => 2,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbr' => 'BSA-AnSci',
            'major' => 'Animal Science',
            'group' => 'bachelor',
            'department_id' => 3,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbr' => 'BSA-FST',
            'major' => 'Food Science and Technology',
            'group' => 'bachelor',
            'department_id' => 5,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbr' => 'BSA-HOR',
            'major' => 'Horticulture',
            'group' => 'bachelor',
            'department_id' => 6,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbr' => 'BSA-PM',
            'major' => 'Pest Management',
            'group' => 'bachelor',
            'department_id' => 7,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbr' => 'BSA-PBG',
            'major' => 'Plant Breeding and Genetics',
            'group' => 'bachelor',
            'department_id' => 8,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbr' => 'BSA-PP',
            'major' => 'Plant Pathology',
            'group' => 'bachelor',
            'department_id' => 9,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agriculture',
            'abbr' => 'BSA-AE',
            'major' => 'Agricultural Economics ',
            'group' => 'bachelor',
            'department_id' => 9,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Development Communication',
            'abbr' => 'BSDC',
            'group' => 'bachelor',
            'department_id' => 4,
        ]);

        // College of Education
        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Elementary Education',
            'abbr' => 'BEED-PSE',
            'major' => 'Pre-School Education',
            'group' => 'bachelor',
            'department_id' => 10,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Elementary Education',
            'abbr' => 'BEED-GE',
            'major' => 'General Education',
            'group' => 'bachelor',
            'department_id' => 10,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbr' => 'BEED-BS',
            'major' => 'Biological Sciences',
            'group' => 'bachelor',
            'department_id' => 10,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbr' => 'BEED-SS',
            'major' => 'Social Studies',
            'group' => 'bachelor',
            'department_id' => 10,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbr' => 'BEED-MATH',
            'major' => 'Mathematics',
            'group' => 'bachelor',
            'department_id' => 10,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbr' => 'BEED-PS',
            'major' => 'Physical Sciences',
            'group' => 'bachelor',
            'department_id' => 10,
        ]);


        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Secondary Education',
            'abbr' => 'BEED-FIL',
            'major' => 'Filipino',
            'group' => 'bachelor',
            'department_id' => 10,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Culture and Arts Education',
            'abbr' => 'BCAED',
            'major' => null,
            'group' => 'bachelor',
            'department_id' => 11,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Physical Education',
            'abbr' => 'BPED',
            'major' => null,
            'group' => 'bachelor',
            'department_id' => 11,
        ]);


        // College of Engineering and Technology
        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agricultural and Biosystems Engineering',
            'abbr' => 'BSABE',
            'major' => null,
            'group' => 'bachelor',
            'department_id' => 14,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Civil Engineering',
            'abbr' => 'BSCE-SE',
            'major' => 'Structural Engineering',
            'group' => 'bachelor',
            'department_id' => 15,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Civil Engineering',
            'abbr' => 'BSCE-CE',
            'major' => 'Construction Engineering',
            'group' => 'bachelor',
            'department_id' => 15,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Civil Engineering',
            'abbr' => 'BSCE-EE',
            'major' => 'Environmental Engineering',
            'group' => 'bachelor',
            'department_id' => 15,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Civil Engineering',
            'abbr' => 'BSCE-WE',
            'major' => 'Water Resources Engineering',
            'group' => 'bachelor',
            'department_id' => 15,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Computer Science',
            'abbr' => 'BSCS',
            'group' => 'bachelor',
            'department_id' => 16,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Geodetic Engineering',
            'abbr' => 'BSGE',
            'group' => 'bachelor',
            'department_id' => 17,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Mechanical Engineering',
            'abbr' => 'BSME',
            'group' => 'bachelor',
            'department_id' => 18,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Meteorology',
            'abbr' => 'BSMET',
            'group' => 'bachelor',
            'department_id' => 19,
        ]);

        //College of
        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Biology',
            'abbr' => 'BSBio',
            'group' => 'bachelor',
            'department_id' => 20,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Biotechnology',
            'abbr' => 'BSBioTech',
            'group' => 'bachelor',
            'department_id' => 25,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Chemistry',
            'abbr' => 'BSChem',
            'group' => 'bachelor',
            'department_id' => 24,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Applied Physics',
            'abbr' => 'BSAP',
            'group' => 'bachelor',
            'department_id' => 22,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Arts in English Language Studies',
            'abbr' => 'BAELS',
            'group' => 'bachelor',
            'department_id' => 21,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Arts in Philosophy',
            'abbr' => 'BSPhilo',
            'group' => 'bachelor',
            'department_id' => 21,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Statistics',
            'abbr' => 'BSStat',
            'group' => 'bachelor',
            'department_id' => 23,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Mathematics',
            'abbr' => 'BSMath',
            'group' => 'bachelor',
            'department_id' => 22,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Doctor of Veterinary Medicine',
            'abbr' => 'DVM-BVM',
            'major' => 'Basic Veterinary Medicine',
            'group' => 'doctor',
            'department_id' => 26,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Doctor of Veterinary Medicine',
            'abbr' => 'DVM-VCS',
            'major' => 'Veterinary Clinical Sciences',
            'group' => 'doctor',
            'department_id' => 27,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Doctor of Veterinary Medicine',
            'abbr' => 'DVM',
            'major' => 'Veterinary Para-Clinical Sciences',
            'group' => 'doctor',
            'department_id' => 28,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Economics',
            'abbr' => 'BSEcon',
            'group' => 'bachelor',
            'department_id' => 32,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Nursing',
            'abbr' => 'BSN',
            'group' => 'bachelor',
            'department_id' => 29,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Tourism Management',
            'abbr' => 'BSTM',
            'group' => 'bachelor',
            'department_id' => 31,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Hospitality Management',
            'abbr' => 'BSHM',
            'group' => 'bachelor',
            'department_id' => 31,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Accountancy',
            'abbr' => 'BSA',
            'group' => 'bachelor',
            'department_id' => 30,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Agribusiness',
            'abbr' => 'BSAgriB',
            'group' => 'bachelor',
            'department_id' => 30,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Forestry',
            'abbr' => 'BSF',
            'group' => 'bachelor',
            'department_id' => 34,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Environmental Science',
            'abbr' => 'BSES',
            'group' => 'bachelor',
            'department_id' => 20,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Marine Biology',
            'abbr' => 'MSMB',
            'group' => 'bachelor',
            'department_id' => 20,
        ]);

        DegreeProgram::factory()->create([
            'name' => 'Bachelor of Science in Food Technology',
            'abbr' => 'BSFT',
            'group' => 'bachelor',
            'department_id' => 25,
        ]);
    }
}
