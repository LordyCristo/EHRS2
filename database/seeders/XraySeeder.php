<?php

namespace Database\Seeders;

use App\Models\Xray;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class XraySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Xray::factory()->count(100)->create();
    }
}
