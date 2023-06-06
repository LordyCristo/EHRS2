<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Services::factory()->create([
            'name' => 'Urinalysis',
            'description' => 'Urine examination',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-1',
        ]);

        Services::factory()->create([
            'name' => 'Fecalysis',
            'description' => 'Feces and stool examination',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-1',
        ]);

        Services::factory()->create([
            'name' => 'CBC',
            'description' => 'Blood examination',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-1',
        ]);

        Services::factory()->create([
            'name' => 'Physical Examination',
            'description' => 'This is where physical examinations are done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Outpatient Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'Radiology',
            'description' => 'This is where X-ray are done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'In/Out-patient Section',
            'room_no' => 'Room-3',
        ]);
    }
}
