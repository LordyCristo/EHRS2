<?php

namespace Database\Seeders;

use App\Models\UrinalysisRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UrinalysisRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UrinalysisRecord::factory(100)->create();
    }
}
