<?php

namespace Database\Seeders;

use App\Models\Hematology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HematologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hematology::factory(100)->create();
    }
}
