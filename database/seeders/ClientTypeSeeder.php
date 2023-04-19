<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Student',
            'Outsider',
            'Faculty',
            'Dependent'
        ];

        foreach ($types as $type) {
            \App\Models\ClientType::create([
                'name' => $type,
            ]);
        }
    }
}
