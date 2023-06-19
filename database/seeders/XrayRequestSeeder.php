<?php

namespace Database\Seeders;

use App\Models\XrayRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class XrayRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        XrayRequest::factory()->count(100)->create();
    }
}
