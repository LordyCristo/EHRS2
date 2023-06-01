<?php

namespace Database\Seeders;

use App\Models\FecalysisRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FecalysisRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FecalysisRecord::factory(100)->create();
    }
}
