<?php

namespace Database\Seeders;

use App\Models\Fees;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fees::factory()->create([
            'service_id' => 1,
            'client_type' => 1,
            'amount' => 100,
        ]);

        Fees::factory()->create([
            'service_id' => 1,
            'client_type' => 2,
            'amount' => 150,
        ]);

        Fees::factory()->create([
            'service_id' => 1,
            'client_type' => 3,
            'amount' => 200,
        ]);

        Fees::factory()->create([
            'service_id' => 1,
            'client_type' => 4,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 2,
            'client_type' => 1,
            'amount' => 100,
        ]);

        Fees::factory()->create([
            'service_id' => 2,
            'client_type' => 2,
            'amount' => 150,
        ]);

        Fees::factory()->create([
            'service_id' => 2,
            'client_type' => 3,
            'amount' => 200,
        ]);

        Fees::factory()->create([
            'service_id' => 2,
            'client_type' => 4,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 3,
            'client_type' => 1,
            'amount' => 100,
        ]);

        Fees::factory()->create([
            'service_id' => 3,
            'client_type' => 2,
            'amount' => 150,
        ]);

        Fees::factory()->create([
            'service_id' => 3,
            'client_type' => 3,
            'amount' => 200,
        ]);

        Fees::factory()->create([
            'service_id' => 3,
            'client_type' => 4,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 4,
            'client_type' => 1,
            'amount' => 100,
        ]);

        Fees::factory()->create([
            'service_id' => 4,
            'client_type' => 2,
            'amount' => 150,
        ]);

        Fees::factory()->create([
            'service_id' => 4,
            'client_type' => 3,
            'amount' => 200,
        ]);

        Fees::factory()->create([
            'service_id' => 4,
            'client_type' => 4,
            'amount' => 250,
        ]);
    }
}
