<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Services::factory()->create([
            'name' => 'ER Section',
            'description' => 'This is where minor emergencies are treated',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-1',
            'is_active' => true,
        ]);

        \App\Models\Services::factory()->create([
            'name' => 'Records Section',
            'description' => 'This is where medical records are kept',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Records Section',
            'room_no' => 'Room-2',
            'is_active' => true,
        ]);

        \App\Models\Services::factory()->create([
            'name' => 'X-Ray Section',
            'description' => 'This is where X-Rays are taken',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'X-Ray Section',
            'room_no' => 'Room-3',
            'is_active' => true,
        ]);

        \App\Models\Services::factory()->create([
            'name' => 'Laboratory Section',
            'description' => 'This is where laboratory tests are done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-4',
            'is_active' => true,
        ]);

        \App\Models\Services::factory()->create([
            'name' => 'Pharmacy Section',
            'description' => 'This is where medicines are dispensed',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Pharmacy Section',
            'room_no' => 'Room-5',
            'is_active' => true,
        ]);

        \App\Models\Services::factory()->create([
            'name' => 'Outpatient Section',
            'description' => 'This is where outpatient consultations are done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Outpatient Section',
            'room_no' => 'Room-6',
            'is_active' => true,
        ]);

        \App\Models\Services::factory()->create([
            'name' => 'Inpatient Section',
            'description' => 'This is where inpatient consultations are done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Inpatient Section',
            'room_no' => 'Room-7',
            'is_active' => true,
        ]);

        \App\Models\Services::factory()->create([
            'name' => 'Billing Section',
            'description' => 'This is where billing is done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Billing Section',
            'room_no' => 'Room-8',
            'is_active' => true,
        ]);
    }
}
