<?php

namespace Database\Seeders;

use App\Models\Urinalysis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UrinalysisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Urinalysis::factory()->count(100)->create();
    }
}
