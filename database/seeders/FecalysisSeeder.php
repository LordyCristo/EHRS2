<?php

namespace Database\Seeders;

use App\Models\Fecalysis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FecalysisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fecalysis::factory(100)->create();
    }
}
