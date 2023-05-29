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
            'abbr' => 'DAEE',
            'college_id' => 1,
        ]);

        Department::factory()->create([
            'name' => 'Department of Agronomy',
            'abbr' => 'DAGR',
            'college_id' => 1,
        ]);

        Department::factory()->create([
            'name' => 'Department of Animal Science',
            'abbr' => 'DANS',
            'college_id' => 1,
        ]);

        Department::factory()->create([
            'name' => 'Department of Development Communication',
            'abbr' => 'DDC',
            'college_id' => 1,
        ]);

        Department::factory()->create([
            'name' => 'Department of Food Science & Technology',
            'abbr' => 'DFST',
            'college_id' => 1,
        ]);

        Department::factory()->create([
            'name' => 'Department of Horticulture',
            'abbr' => 'DHOR',
            'college_id' => 1,
        ]);

        Department::factory()->create([
            'name' => 'Department of Pest Management',
            'abbr' => 'DPM',
            'college_id' => 1,
        ]);

        Department::factory()->create([
            'name' => 'Department of Plant Breeding and Genetics',
            'abbr' => 'DPBG',
            'college_id' => 1,
        ]);

        Department::factory()->create([
            'name' => 'Department of Soil Science',
            'abbr' => 'DSS',
            'college_id' => 1,
        ]);

        // College of Education
        Department::factory()->create([
            'name' => 'Department of Teacher Education',
            'abbr' => 'DTE',
            'college_id' => 2,
        ]);

        Department::factory()->create([
            'name' => 'Institute of Human Kinetics',
            'abbr' => 'IHK',
            'college_id' => 2,
        ]);

        Department::factory()->create([
            'name' => 'VSU Laboratory High School',
            'abbr' => 'VSLHS',
            'college_id' => 2,
        ]);

        Department::factory()->create([
            'name' => 'VSU Senior High School',
            'abbr' => 'VSSHS',
            'college_id' => 2,
        ]);

        // College of Engineering and Technology
        Department::factory()->create([
            'name' => 'Department of Agricultural and Biosystems Engineering',
            'abbr' => 'DABE',
            'college_id' => 3,
        ]);

        Department::factory()->create([
            'name' => 'Department of Civil Engineering',
            'abbr' => 'DCE',
            'college_id' => 3,
        ]);

        Department::factory()->create([
            'name' => 'Department of Computer Science and Technology',
            'abbr' => 'DCST',
            'college_id' => 3,
        ]);

        Department::factory()->create([
            'name' => 'Department of Geodetic Engineering',
            'abbr' => 'DGE',
            'college_id' => 3,
        ]);

        Department::factory()->create([
            'name' => 'Department of Mechanical Engineering',
            'abbr' => 'DME',
            'college_id' => 3,
        ]);

        Department::factory()->create([
            'name' => 'Department of Meteorology',
            'abbr' => 'DMET',
            'college_id' => 3,
        ]);

        // College of Arts and Sciences
        Department::factory()->create([
            'name' => 'Department of Biological Sciences',
            'abbr' => 'DBS',
            'college_id' => 4,
        ]);

        Department::factory()->create([
            'name' => 'Department of Liberal Arts and Behavioral Sciences',
            'abbr' => 'DLABS',
            'college_id' => 4,
        ]);

        Department::factory()->create([
            'name' => 'Department of Mathematics and Physics',
            'abbr' => 'DMP',
            'college_id' => 4,
        ]);

        Department::factory()->create([
            'name' => 'Department of Statistics',
            'abbr' => 'DSTAT',
            'college_id' => 4,
        ]);

        Department::factory()->create([
            'name' => 'Department of Pure and Applied Chemistry',
            'abbr' => 'DPAC',
            'college_id' => 4,
        ]);

        Department::factory()->create([
            'name' => 'Department of Biotechnology',
            'abbr' => 'DBT',
            'college_id' => 4,
        ]);

        // College of Veterinary Medicine
        Department::factory()->create([
            'name' => 'Department of Basic Veterinary Sciences',
            'abbr' => 'DBVS',
            'college_id' => 5,
        ]);

        Department::factory()->create([
            'name' => 'Department of Veterinary Clinical Sciences',
            'abbr' => 'DVCS',
            'college_id' => 5,
        ]);

        Department::factory()->create([
            'name' => 'Department of Veterinary Para-Clinical Sciences',
            'abbr' => 'DVPCS',
            'college_id' => 5,
        ]);

        //  College of Nursing
        Department::factory()->create([
            'name' => 'Department of Nursing',
            'abbr' => 'DoN',
            'college_id' => 6,
        ]);

        // College of Management and Economics
        Department::factory()->create([
            'name' => 'Department of Business and Management',
            'abbr' => 'DBM',
            'college_id' => 7,
        ]);

        Department::factory()->create([
            'name' => 'Department of Consumer and Hospitality Management',
            'abbr' => 'DCHM',
            'college_id' => 7,
        ]);

        Department::factory()->create([
            'name' => 'Department of Economics',
            'abbr' => 'DoE',
            'college_id' => 7,
        ]);

        Department::factory()->create([
            'name' => 'Institute for Strategic Research and Development Studies',
            'abbr' => 'ISRD',
            'college_id' => 7,
        ]);

        // College of Forestry and Environmental Science
        Department::factory()->create([
            'name' => 'Department of Forest Science',
            'abbr' => 'DFS',
            'college_id' => 8,
        ]);

        Department::factory()->create([
            'name' => 'Institute of Tropical Ecology & Environmental Management',
            'abbr' => 'ITEEM',
            'college_id' => 8,
        ]);

    }
}
