<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClientType;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientType::factory()->create(['name' => 'Student']);
        ClientType::factory()->create(['name' => 'Faculty']);
        ClientType::factory()->create(['name' => 'Dependent']);
        ClientType::factory()->create(['name' => 'Outsider']);
    }
}
