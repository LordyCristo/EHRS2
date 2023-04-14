<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // College of Agriculture and Food Science
        Department::factory()->create([
            'name' => 'Department of Agricultural Education and Extension',
            'abbreviation' => 'DAEE',
            'college_id' => 1,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Agronomy',
            'abbreviation' => 'DAGR',
            'college_id' => 1,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Animal Science',
            'abbreviation' => 'DANS',
            'college_id' => 1,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Development Communication',
            'abbreviation' => 'DDC',
            'college_id' => 1,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Food Science & Technology',
            'abbreviation' => 'DFST',
            'college_id' => 1,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Horticulture',
            'abbreviation' => 'DHOR',
            'college_id' => 1,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Pest Management',
            'abbreviation' => 'DPM',
            'college_id' => 1,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Plant Breeding and Genetics',
            'abbreviation' => 'DPBG',
            'college_id' => 1,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Soil Science',
            'abbreviation' => 'DSS',
            'college_id' => 1,
            'is_active' => true,
        ]);

        // College of Education
        Department::factory()->create([
            'name' => 'Department of Teacher Education',
            'abbreviation' => 'DTE',
            'college_id' => 2,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Institute of Human Kinetics',
            'abbreviation' => 'IHK',
            'college_id' => 2,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'VSU Laboratory High School',
            'abbreviation' => 'VSLHS',
            'college_id' => 2,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'VSU Senior High School',
            'abbreviation' => 'VSSHS',
            'college_id' => 2,
            'is_active' => true,
        ]);

        // College of Engineering and Technology
        Department::factory()->create([
            'name' => 'Department of Agricultural and Biosystems Engineering',
            'abbreviation' => 'DABE',
            'college_id' => 3,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Civil Engineering',
            'abbreviation' => 'DCE',
            'college_id' => 3,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Computer Science and Technology',
            'abbreviation' => 'DCST',
            'college_id' => 3,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Geodetic Engineering',
            'abbreviation' => 'DGE',
            'college_id' => 3,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Mechanical Engineering',
            'abbreviation' => 'DME',
            'college_id' => 3,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Meteorology',
            'abbreviation' => 'DMET',
            'college_id' => 3,
            'is_active' => true,
        ]);

        // College of Arts and Sciences
        Department::factory()->create([
            'name' => 'Department of Biological Sciences',
            'abbreviation' => 'DBS',
            'college_id' => 4,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Liberal Arts and Behavioral Sciences',
            'abbreviation' => 'DLABS',
            'college_id' => 4,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Mathematics and Physics',
            'abbreviation' => 'DMP',
            'college_id' => 4,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Statistics',
            'abbreviation' => 'DSTAT',
            'college_id' => 4,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Pure and Applied Chemistry',
            'abbreviation' => 'DPAC',
            'college_id' => 4,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Biotechnology',
            'abbreviation' => 'DBT',
            'college_id' => 4,
            'is_active' => true,
        ]);

        // College of Veterinary Medicine
        Department::factory()->create([
            'name' => 'Department of Basic Veterinary Sciences',
            'abbreviation' => 'DBVS',
            'college_id' => 5,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Veterinary Clinical Sciences',
            'abbreviation' => 'DVCS',
            'college_id' => 5,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Veterinary Para-Clinical Sciences',
            'abbreviation' => 'DVPCS',
            'college_id' => 5,
            'is_active' => true,
        ]);

        //  College of Nursing
        Department::factory()->create([
            'name' => 'Department of Nursing',
            'abbreviation' => 'DoN',
            'college_id' => 6,
            'is_active' => true,
        ]);

        // College of Management and Economics
        Department::factory()->create([
            'name' => 'Department of Business and Management',
            'abbreviation' => 'DBM',
            'college_id' => 7,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Consumer and Hospitality Management',
            'abbreviation' => 'DCHM',
            'college_id' => 7,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Department of Economics',
            'abbreviation' => 'DoE',
            'college_id' => 7,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Institute for Strategic Research and Development Studies',
            'abbreviation' => 'ISRD',
            'college_id' => 7,
            'is_active' => true,
        ]);

        // College of Forestry and Environmental Science
        Department::factory()->create([
            'name' => 'Department of Forest Science',
            'abbreviation' => 'DFS',
            'college_id' => 8,
            'is_active' => true,
        ]);

        Department::factory()->create([
            'name' => 'Institute of Tropical Ecology & Environmental Management',
            'abbreviation' => 'ITEEM',
            'college_id' => 8,
            'is_active' => true,
        ]);

    }
}
