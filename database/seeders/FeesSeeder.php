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
        //Normal procedure
        Fees::factory()->create([
            'service_id' => 1,
            'client_type' => 1, // VSU STUDENT
            'amount' => 75,
        ]);

        Fees::factory()->create([
            'service_id' => 1,
            'client_type' => 2, // VSU STAFF
            'amount' => 180,
        ]);

        Fees::factory()->create([
            'service_id' => 1,
            'client_type' => 3, // VSU DEPENDENT
            'amount' => 180,
        ]);

        Fees::factory()->create([
            'service_id' => 1,
            'client_type' => 4, // OUTSIDERS
            'amount' => 300,
        ]);
        //by bur
        Fees::factory()->create([
            'service_id' => 2,
            'client_type' => 1, // VSU STUDENT
            'amount' => 100,
        ]);

        Fees::factory()->create([
            'service_id' => 2,
            'client_type' => 2,
            'amount' => 200,
        ]);

        Fees::factory()->create([
            'service_id' => 2,
            'client_type' => 3,
            'amount' => 200,
        ]);

        Fees::factory()->create([
            'service_id' => 2,
            'client_type' => 4,
            'amount' => 500,
        ]);

        //with stature
        Fees::factory()->create([
            'service_id' => 3,
            'client_type' => 1,
            'amount' => 200,
        ]);

        Fees::factory()->create([
            'service_id' => 3,
            'client_type' => 2,
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 3,
            'client_type' => 3,
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 3,
            'client_type' => 4,
            'amount' => 500,
        ]);

        //complicated tooth extraction
        Fees::factory()->create([
            'service_id' => 4,
            'client_type' => 1,
            'amount' => 2500,
        ]);

        Fees::factory()->create([
            'service_id' => 4,
            'client_type' => 2,
            'amount' => 4000,
        ]);

        Fees::factory()->create([
            'service_id' => 4,
            'client_type' => 3,
            'amount' => 4000,
        ]);

        Fees::factory()->create([
            'service_id' => 4,
            'client_type' => 4,
            'amount' => 6000,
        ]);

        //class 1,2,3,4,5,6
        Fees::factory()->create([
            'service_id' => 5,
            'client_type' => 1,
            'amount' => 140,
        ]);

        Fees::factory()->create([
            'service_id' => 5,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 5,
            'client_type' => 3,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 5,
            'client_type' => 4,
            'amount' => 400,
        ]);

        //Closure of diastema
        Fees::factory()->create([
            'service_id' => 6,
            'client_type' => 1,
            'amount' => 140,
        ]);

        Fees::factory()->create([
            'service_id' => 6,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 6,
            'client_type' => 3,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 6,
            'client_type' => 4,
            'amount' => 700,
        ]);

        //supra gingival scaling
        Fees::factory()->create([
            'service_id' => 7,
            'client_type' => 1,
            'amount' => 150,
        ]);

        Fees::factory()->create([
            'service_id' => 7,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 7,
            'client_type' => 3,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 7,
            'client_type' => 4,
            'amount' => 500,
        ]);

        //gingivitis
        Fees::factory()->create([
            'service_id' => 8,
            'client_type' => 1,
            'amount' => 150,
        ]);

        Fees::factory()->create([
            'service_id' => 8,
            'client_type' => 2,
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 8,
            'client_type' => 3,
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 8,
            'client_type' => 4,
            'amount' => 600,
        ]);

        //treatment of periodontitis
        Fees::factory()->create([
            'service_id' => 9,
            'client_type' => 1,
            'amount' => 150,
        ]);

        Fees::factory()->create([
            'service_id' => 9,
            'client_type' => 2,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 9,
            'client_type' => 3,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 9,
            'client_type' => 4,
            'amount' => 800,
        ]);
        //ABDOMEN AP UPRIGHT AND SUPINE (ADULTS)
        Fees::factory()->create([
            'service_id' => 10,
            'client_type' => 1, // Student
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 10,
            'client_type' => 2, // VSU Staff
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 10,
            'client_type' => 3, // Dependent
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 10,
            'client_type' => 4, // Outsider
            'amount' => 800,
        ]);

        Fees::factory()->create([
            'service_id' => 11,
            'client_type' => 1, // Student
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 11,
            'client_type' => 2, // VSU Staff
            'amount' => 465,
        ]);

        Fees::factory()->create([
            'service_id' => 11,
            'client_type' => 3, // Dependent
            'amount' => 465,
        ]);

        Fees::factory()->create([
            'service_id' => 11,
            'client_type' => 4, // Outsider
            'amount' => 500,
        ]);
        //ARM AP/LATERAL
        Fees::factory()->create([
            'service_id' => 12,
            'client_type' => 1, // Student
            'amount' => 280,
        ]);

        Fees::factory()->create([
            'service_id' => 12,
            'client_type' => 2, // VSU Staff
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 12,
            'client_type' => 3, // Dependent
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 12,
            'client_type' => 4, // Outsider
            'amount' => 465,
        ]);

        //CERVICAL SPINE APL
        Fees::factory()->create([
            'service_id' => 13,
            'client_type' => 1, // Student
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 13,
            'client_type' => 2, // VSU Staff
            'amount' => 465,
        ]);

        Fees::factory()->create([
            'service_id' => 13,
            'client_type' => 3, // Dependent
            'amount' => 45,
        ]);

        Fees::factory()->create([
            'service_id' => 13,
            'client_type' => 4, // Outsider
            'amount' => 500,
        ]);
        // CHEST PA
        Fees::factory()->create([
            'service_id' => 14,
            'client_type' => 1, // Student
            'amount' => 170,
        ]);

        Fees::factory()->create([
            'service_id' => 14,
            'client_type' => 2, // VSU Staff
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 14,
            'client_type' => 3, // Dependent
            'amount' => 330,
        ]);

        Fees::factory()->create([
            'service_id' => 14,
            'client_type' => 4, // Outsider
            'amount' => 330,
        ]);
        // CHEST PA : LATERAL
        Fees::factory()->create([
            'service_id' => 15,
            'client_type' => 1, // Student
            'amount' => 280,
        ]);

        Fees::factory()->create([
            'service_id' => 15,
            'client_type' => 2, // VSU Staff
            'amount' => 290,
        ]);

        Fees::factory()->create([
            'service_id' => 15,
            'client_type' => 3, // Dependent
            'amount' => 290,
        ]);

        Fees::factory()->create([
            'service_id' => 15,
            'client_type' => 4, // Outsider
            'amount' => 320,
        ]);

        Fees::factory()->create([
            'service_id' => 16,
            'client_type' => 1, // Student
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 16,
            'client_type' => 2, // VSU Staff
            'amount' => 470,
        ]);

        Fees::factory()->create([
            'service_id' => 16,
            'client_type' => 3, // Dependent
            'amount' => 520,
        ]);

        Fees::factory()->create([
            'service_id' => 16,
            'client_type' => 4, // Outsider
            'amount' => 520,
        ]);

        Fees::factory()->create([
            'service_id' => 17,
            'client_type' => 1, // Student
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 17,
            'client_type' => 2, // VSU Staff
            'amount' => 465,
        ]);

        Fees::factory()->create([
            'service_id' => 17,
            'client_type' => 3, // Dependent
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 17,
            'client_type' => 4, // Outsider
            'amount' => 550,
        ]);

        Fees::factory()->create([
            'service_id' => 18,
            'client_type' => 1, // Student
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 18,
            'client_type' => 2, // VSU Staff
            'amount' => 465,
        ]);

        Fees::factory()->create([
            'service_id' => 18,
            'client_type' => 3, // Dependent
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 18,
            'client_type' => 4, // Outsider
            'amount' => 550,
        ]);

        Fees::factory()->create([
            'service_id' => 19,
            'client_type' => 1, // Student
            'amount' => 550,
        ]);

        Fees::factory()->create([
            'service_id' => 19,
            'client_type' => 2, // VSU Staff
            'amount' => 675,
        ]);

        Fees::factory()->create([
            'service_id' => 19,
            'client_type' => 3, // Dependent
            'amount' => 740,
        ]);

        Fees::factory()->create([
            'service_id' => 19,
            'client_type' => 4, // Outsider
            'amount' => 740,
        ]);

        Fees::factory()->create([
            'service_id' => 20,
            'client_type' => 1, // Student
            'amount' => 280,
        ]);

        Fees::factory()->create([
            'service_id' => 20,
            'client_type' => 2, // VSU Staff
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 20,
            'client_type' => 3, // Dependent
            'amount' => 465,
        ]);

        Fees::factory()->create([
            'service_id' => 20,
            'client_type' => 4, // Outsider
            'amount' => 500,
        ]);

// Service ID: 21
        Fees::factory()->create([
            'service_id' => 21,
            'client_type' => 1, // Student
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 21,
            'client_type' => 2, // VSU Staff
            'amount' => 465,
        ]);

        Fees::factory()->create([
            'service_id' => 21,
            'client_type' => 3, // Dependent
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 21,
            'client_type' => 4, // Outsider
            'amount' => 550,
        ]);

        Fees::factory()->create([
            'service_id' => 22,
            'client_type' => 1, // Student
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 22,
            'client_type' => 2, // VSU Staff
            'amount' => 465,
        ]);

        Fees::factory()->create([
            'service_id' => 22,
            'client_type' => 3, // Dependent
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 22,
            'client_type' => 4, // Outsider
            'amount' => 550,
        ]);
        Fees::factory()->create([
            'service_id' => 23,
            'client_type' => 1,
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 23,
            'client_type' => 2,
            'amount' => 465,
        ]);

        Fees::factory()->create([
            'service_id' => 23,
            'client_type' => 3,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 24,
            'client_type' => 1,
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 24,
            'client_type' => 2,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 24,
            'client_type' => 3,
            'amount' => 550,
        ]);

        Fees::factory()->create([
            'service_id' => 25,
            'client_type' => 1,
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 25,
            'client_type' => 2,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 25,
            'client_type' => 3,
            'amount' => 550,
        ]);

        Fees::factory()->create([
            'service_id' => 26,
            'client_type' => 1,
            'amount' => 550,
        ]);

        Fees::factory()->create([
            'service_id' => 26,
            'client_type' => 2,
            'amount' => 675,
        ]);

        Fees::factory()->create([
            'service_id' => 26,
            'client_type' => 3,
            'amount' => 740,
        ]);

        Fees::factory()->create([
            'service_id' => 27,
            'client_type' => 1,
            'amount' => 280,
        ]);

        Fees::factory()->create([
            'service_id' => 27,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 27,
            'client_type' => 3,
            'amount' => 330,
        ]);

        Fees::factory()->create([
            'service_id' => 28,
            'client_type' => 1,
            'amount' => 170,
        ]);

        Fees::factory()->create([
            'service_id' => 28,
            'client_type' => 2,
            'amount' => 290,
        ]);

        Fees::factory()->create([
            'service_id' => 28,
            'client_type' => 3,
            'amount' => 320,
        ]);

        Fees::factory()->create([
            'service_id' => 29,
            'client_type' => 1,
            'amount' => 280,
        ]);

        Fees::factory()->create([
            'service_id' => 29,
            'client_type' => 2,
            'amount' => 470,
        ]);

        Fees::factory()->create([
            'service_id' => 29,
            'client_type' => 3,
            'amount' => 520,
        ]);

        Fees::factory()->create([
            'service_id' => 30,
            'client_type' => 1,
            'amount' => 340,
        ]);

        Fees::factory()->create([
            'service_id' => 30,
            'client_type' => 2,
            'amount' => 470,
        ]);

        Fees::factory()->create([
            'service_id' => 30,
            'client_type' => 3,
            'amount' => 520,
        ]);

        Fees::factory()->create([
            'service_id' => 31,
            'client_type' => 1,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 31,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 31,
            'client_type' => 3,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 31,
            'client_type' => 4,
            'amount' => 330,
        ]);

        Fees::factory()->create([
            'service_id' => 32,
            'client_type' => 1,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 32,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 32,
            'client_type' => 3,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 32,
            'client_type' => 4,
            'amount' => 330,
        ]);

        Fees::factory()->create([
            'service_id' => 33,
            'client_type' => 1,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 33,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 33,
            'client_type' => 3,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 33,
            'client_type' => 4,
            'amount' => 330,
        ]);
        //CBC
        Fees::factory()->create([
            'service_id' => 34,
            'client_type' => 1,
            'amount' => 145,
        ]);

        Fees::factory()->create([
            'service_id' => 34,
            'client_type' => 2,
            'amount' => 190,
        ]);

        Fees::factory()->create([
            'service_id' => 34,
            'client_type' => 3,
            'amount' => 190,
        ]);

        Fees::factory()->create([
            'service_id' => 34,
            'client_type' => 4,
            'amount' => 220,
        ]);
        // Hematocrit
        Fees::factory()->create([
            'service_id' => 35,
            'client_type' => 1,
            'amount' => 40,
        ]);

        Fees::factory()->create([
            'service_id' => 35,
            'client_type' => 2,
            'amount' => 60,
        ]);

        Fees::factory()->create([
            'service_id' => 35,
            'client_type' => 3,
            'amount' => 60,
        ]);

        Fees::factory()->create([
            'service_id' => 35,
            'client_type' => 4,
            'amount' => 80,
        ]);
        // blood typing
        Fees::factory()->create([
            'service_id' => 36,
            'client_type' => 1,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 36,
            'client_type' => 2,
            'amount' => 70,
        ]);

        Fees::factory()->create([
            'service_id' => 36,
            'client_type' => 3,
            'amount' => 70,
        ]);

        Fees::factory()->create([
            'service_id' => 36,
            'client_type' => 4,
            'amount' => 85,
        ]);
        //RH typing
        Fees::factory()->create([
            'service_id' => 37,
            'client_type' => 1,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 37,
            'client_type' => 2,
            'amount' => 70,
        ]);

        Fees::factory()->create([
            'service_id' => 37,
            'client_type' => 3,
            'amount' => 70,
        ]);

        Fees::factory()->create([
            'service_id' => 37,
            'client_type' => 4,
            'amount' => 85,
        ]);
        //Urinalysis
        //35	85	90
        Fees::factory()->create([
            'service_id' => 38,
            'client_type' => 1,
            'amount' => 35,
        ]);

        Fees::factory()->create([
            'service_id' => 38,
            'client_type' => 2,
            'amount' => 85,
        ]);

        Fees::factory()->create([
            'service_id' => 38,
            'client_type' => 3,
            'amount' => 85,
        ]);

        Fees::factory()->create([
            'service_id' => 38,
            'client_type' => 4,
            'amount' => 90,
        ]);
        //capillary blood sugar
        Fees::factory()->create([
            'service_id' => 39,
            'client_type' => 1,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 39,
            'client_type' => 2,
            'amount' => 90,
        ]);

        Fees::factory()->create([
            'service_id' => 39,
            'client_type' => 3,
            'amount' => 90,
        ]);

        Fees::factory()->create([
            'service_id' => 39,
            'client_type' => 4,
            'amount' => 100,
        ]);
        //Fecalysis
        //35	75	85
        Fees::factory()->create([
            'service_id' => 40,
            'client_type' => 1,
            'amount' => 35,
        ]);

        Fees::factory()->create([
            'service_id' => 40,
            'client_type' => 2,
            'amount' => 75,
        ]);

        Fees::factory()->create([
            'service_id' => 40,
            'client_type' => 3,
            'amount' => 75,
        ]);

        Fees::factory()->create([
            'service_id' => 40,
            'client_type' => 4,
            'amount' => 85,
        ]);
        //pregnancy test
        //60	90	100
        Fees::factory()->create([
            'service_id' => 41,
            'client_type' => 1,
            'amount' => 60,
        ]);

        Fees::factory()->create([
            'service_id' => 41,
            'client_type' => 2,
            'amount' => 90,
        ]);

        Fees::factory()->create([
            'service_id' => 41,
            'client_type' => 3,
            'amount' => 90,
        ]);

        Fees::factory()->create([
            'service_id' => 41,
            'client_type' => 4,
            'amount' => 100,
        ]);

        //medical certificate
        Fees::factory()->create([
            'service_id' => 42,
            'client_type' => 1,
            'amount' => 10,
        ]);

        Fees::factory()->create([
            'service_id' => 42,
            'client_type' => 2,
            'amount' => 30,
        ]);

        Fees::factory()->create([
            'service_id' => 42,
            'client_type' => 3,
            'amount' => 30,
        ]);

        Fees::factory()->create([
            'service_id' => 42,
            'client_type' => 4,
            'amount' => 150,
        ]);

        //MINOR SURGERY: SUTURING (SMALL)
        Fees::factory()->create([
            'service_id' => 43,
            'client_type' => 1,
            'amount' => 200,
        ]);

        Fees::factory()->create([
            'service_id' => 43,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 43,
            'client_type' => 3,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 43,
            'client_type' => 4,
            'amount' => 400,
        ]);

        //MINOR SURGERY: SUTURING (MEDIUM)
        //350 500 600
        Fees::factory()->create([
            'service_id' => 44,
            'client_type' => 1,
            'amount' => 350,
        ]);

        Fees::factory()->create([
            'service_id' => 44,
            'client_type' => 2,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 44,
            'client_type' => 3,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 44,
            'client_type' => 4,
            'amount' => 600,
        ]);

        //MINOR SURGERY: SUTURING (LARGE)
        Fees::factory()->create([
            'service_id' => 45,
            'client_type' => 1,
            'amount' => 600,
        ]);

        Fees::factory()->create([
            'service_id' => 45,
            'client_type' => 2,
            'amount' => 900,
        ]);

        Fees::factory()->create([
            'service_id' => 45,
            'client_type' => 3,
            'amount' => 900,
        ]);

        Fees::factory()->create([
            'service_id' => 45,
            'client_type' => 4,
            'amount' => 1000,
        ]);

        //Minor Surgery: Wound Dressing (Small)
        Fees::factory()->create([
            'service_id' => 46,
            'client_type' => 2,
            'amount' => 30,
        ]);

        Fees::factory()->create([
            'service_id' => 46,
            'client_type' => 3,
            'amount' => 30,
        ]);

        Fees::factory()->create([
            'service_id' => 46,
            'client_type' => 4,
            'amount' => 75,
        ]);

        //Minor Surgery: Wound Dressing (Medium)
        Fees::factory()->create([
            'service_id' => 47,
            'client_type' => 2,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 47,
            'client_type' => 3,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 47,
            'client_type' => 4,
            'amount' => 100,
        ]);

        //Minor Surgery: Wound Dressing (Large)
        Fees::factory()->create([
            'service_id' => 48,
            'client_type' => 2,
            'amount' => 100,
        ]);

        Fees::factory()->create([
            'service_id' => 48,
            'client_type' => 3,
            'amount' => 100,
        ]);

        Fees::factory()->create([
            'service_id' => 48,
            'client_type' => 4,
            'amount' => 200,
        ]);

        //Minor Surgery: Removal of Sutures
        Fees::factory()->create([
            'service_id' => 49,
            'client_type' => 2,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 49,
            'client_type' => 3,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 49,
            'client_type' => 4,
            'amount' => 100,
        ]);

        //Minor Surgery: Referral Injection

        Fees::factory()->create([
            'service_id' => 50,
            'client_type' => 2,
            'amount' => 30,
        ]);

        Fees::factory()->create([
            'service_id' => 50,
            'client_type' => 3,
            'amount' => 30,
        ]);

        Fees::factory()->create([
            'service_id' => 50,
            'client_type' => 4,
            'amount' => 50,
        ]);

        //Minor Surgery: I and D
        //30 300 400
        Fees::factory()->create([
            'service_id' => 51,
            'client_type' => 1,
            'amount' => 30,
        ]);

        Fees::factory()->create([
            'service_id' => 51,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 51,
            'client_type' => 3,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 51,
            'client_type' => 4,
            'amount' => 400,
        ]);

        //Minor Surgery: Debridement Dressing (D&D)
        Fees::factory()->create([
            'service_id' => 52,
            'client_type' => 1,
            'amount' => 30,
        ]);

        Fees::factory()->create([
            'service_id' => 52,
            'client_type' => 2,
            'amount' => 350,
        ]);

        Fees::factory()->create([
            'service_id' => 52,
            'client_type' => 3,
            'amount' => 350,
        ]);

        Fees::factory()->create([
            'service_id' => 52,
            'client_type' => 4,
            'amount' => 500,
        ]);

        //Minor Surgery: Re-insertion of IV
        Fees::factory()->create([
            'service_id' => 53,
            'client_type' => 1,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 53,
            'client_type' => 2,
            'amount' => 75,
        ]);

        Fees::factory()->create([
            'service_id' => 53,
            'client_type' => 3,
            'amount' => 75,
        ]);

        Fees::factory()->create([
            'service_id' => 53,
            'client_type' => 4,
            'amount' => 100,
        ]);

        //Minor Surgery: Catheterization
        //500	800
        Fees::factory()->create([
            'service_id' => 54,
            'client_type' => 2,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 54,
            'client_type' => 3,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 54,
            'client_type' => 4,
            'amount' => 800,
        ]);

        //Minor Surgery: NGT
        // 500 800
        Fees::factory()->create([
            'service_id' => 55,
            'client_type' => 2,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 55,
            'client_type' => 3,
            'amount' => 500,
        ]);

        Fees::factory()->create([
            'service_id' => 55,
            'client_type' => 4,
            'amount' => 800,
        ]);

        //Minor Surgery: Excision (Small)
        //200 400 500
        Fees::factory()->create([
            'service_id' => 56,
            'client_type' => 1,
            'amount' => 200,
        ]);

        Fees::factory()->create([
            'service_id' => 56,
            'client_type' => 2,
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 56,
            'client_type' => 3,
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 56,
            'client_type' => 4,
            'amount' => 500,
        ]);

        //Minor Surgery: Excision (Medium)
        //400 600 1000
        Fees::factory()->create([
            'service_id' => 57,
            'client_type' => 1,
            'amount' => 400,
        ]);

        Fees::factory()->create([
            'service_id' => 57,
            'client_type' => 2,
            'amount' => 600,
        ]);

        Fees::factory()->create([
            'service_id' => 57,
            'client_type' => 3,
            'amount' => 600,
        ]);

        Fees::factory()->create([
            'service_id' => 57,
            'client_type' => 4,
            'amount' => 1000,
        ]);

        //Minor Surgery: Excision (Large)
        Fees::factory()->create([
            'service_id' => 58,
            'client_type' => 1,
            'amount' => 1000,
        ]);

        Fees::factory()->create([
            'service_id' => 58,
            'client_type' => 2,
            'amount' => 1200,
        ]);

        Fees::factory()->create([
            'service_id' => 58,
            'client_type' => 3,
            'amount' => 1200,
        ]);

        Fees::factory()->create([
            'service_id' => 58,
            'client_type' => 4,
            'amount' => 1500,
        ]);

        //Minor Surgery: Circumcision
        Fees::factory()->create([
            'service_id' => 59,
            'client_type' => 2,
            'amount' => 800,
        ]);

        Fees::factory()->create([
            'service_id' => 59,
            'client_type' => 3,
            'amount' => 800,
        ]);

        Fees::factory()->create([
            'service_id' => 59,
            'client_type' => 4,
            'amount' => 900,
        ]);

        //Minor Surgery: Removal of Foreign Body
        //20 300 400
        Fees::factory()->create([
            'service_id' => 60,
            'client_type' => 1,
            'amount' => 20,
        ]);

        Fees::factory()->create([
            'service_id' => 60,
            'client_type' => 2,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 60,
            'client_type' => 3,
            'amount' => 300,
        ]);

        Fees::factory()->create([
            'service_id' => 60,
            'client_type' => 4,
            'amount' => 400,
        ]);

        //Minor Surgery: Prenatal Fee
        Fees::factory()->create([
            'service_id' => 61,
            'client_type' => 2,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 61,
            'client_type' => 3,
            'amount' => 50,
        ]);

        Fees::factory()->create([
            'service_id' => 61,
            'client_type' => 4,
            'amount' => 100,
        ]);

        //Minor Surgery: Fee for lost OPD No.
        Fees::factory()->create([
            'service_id' => 62,
            'client_type' => 2,
            'amount' => 75,
        ]);

        Fees::factory()->create([
            'service_id' => 62,
            'client_type' => 3,
            'amount' => 75,
        ]);

        Fees::factory()->create([
            'service_id' => 62,
            'client_type' => 4,
            'amount' => 100,
        ]);

        //Minor Surgery: Consultation fee after office hours
        Fees::factory()->create([
            'service_id' => 63,
            'client_type' => 2,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 63,
            'client_type' => 3,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 63,
            'client_type' => 4,
            'amount' => 300,
        ]);

        //Minor Surgery: ER FEE
        Fees::factory()->create([
            'service_id' => 64,
            'client_type' => 2,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 64,
            'client_type' => 3,
            'amount' => 250,
        ]);

        Fees::factory()->create([
            'service_id' => 64,
            'client_type' => 4,
            'amount' => 300,
        ]);

        //Minor Surgery: Nebulization Fee: with meds
        Fees::factory()->create([
            'service_id' => 65,
            'client_type' => 1,
            'amount' => 25,
        ]);

        Fees::factory()->create([
            'service_id' => 65,
            'client_type' => 2,
            'amount' => 75,
        ]);

        Fees::factory()->create([
            'service_id' => 65,
            'client_type' => 3,
            'amount' => 75,
        ]);

        Fees::factory()->create([
            'service_id' => 65,
            'client_type' => 4,
            'amount' => 100,
        ]);

        //Minor Surgery: Nebulization Fee: without meds
        Fees::factory()->create([
            'service_id' => 66,
            'client_type' => 1,
            'amount' => 65,
        ]);

        Fees::factory()->create([
            'service_id' => 66,
            'client_type' => 2,
            'amount' => 100,
        ]);

        Fees::factory()->create([
            'service_id' => 66,
            'client_type' => 3,
            'amount' => 100,
        ]);

        Fees::factory()->create([
            'service_id' => 66,
            'client_type' => 4,
            'amount' => 150,
        ]);

//        //Ambulance Fee: WLPH to Baybay City
//        Fees::factory()->create([
//            'service_id' => 67,
//            'client_type' => 2,
//            'amount' => 400,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 67,
//            'client_type' => 3,
//            'amount' => 400,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 67,
//            'client_type' => 4,
//            'amount' => 500,
//        ]);
//
//        //Ambulance Fee: OSPA to Ormoc City
//        Fees::factory()->create([
//            'service_id' => 68,
//            'client_type' => 2,
//            'amount' => 1200,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 68,
//            'client_type' => 3,
//            'amount' => 1200,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 68,
//            'client_type' => 4,
//            'amount' => 1800,
//        ]);
//
//        //Ambulance Fee: EVRMC to Tacloban City
//        //2300 2800 3000
//        Fees::factory()->create([
//            'service_id' => 69,
//            'client_type' => 1,
//            'amount' => 2300,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 69,
//            'client_type' => 2,
//            'amount' => 2800,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 69,
//            'client_type' => 3,
//            'amount' => 2800,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 69,
//            'client_type' => 4,
//            'amount' => 3000,
//        ]);
//
//        //Ambulance Fee: Hilongos Leyte
//        Fees::factory()->create([
//            'service_id' => 70,
//            'client_type' => 1,
//            'amount' => 1800,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 70,
//            'client_type' => 2,
//            'amount' => 2000,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 70,
//            'client_type' => 3,
//            'amount' => 2000,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 70,
//            'client_type' => 4,
//            'amount' => 2200,
//        ]);
//
//        //Ambulance Fee: Maasin City
//        Fees::factory()->create([
//            'service_id' => 71,
//            'client_type' => 1,
//            'amount' => 2800,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 71,
//            'client_type' => 2,
//            'amount' => 3100,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 71,
//            'client_type' => 3,
//            'amount' => 3100,
//        ]);
//
//        Fees::factory()->create([
//            'service_id' => 71,
//            'client_type' => 4,
//            'amount' => 3500,
//        ]);
    }
}
