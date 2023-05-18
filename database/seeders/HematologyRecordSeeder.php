<?php

namespace Database\Seeders;

use App\Models\HematologyRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HematologyRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HematologyRecord::factory(100)->create();
    }
}
