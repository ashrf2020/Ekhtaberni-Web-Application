<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BloodType;
use Illuminate\Support\Facades\DB;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blood_types')->delete();
        $bloodTypes = [
            ['name' => 'A+', 'notes' => 'Most common blood type'],
            ['name' => 'A-', 'notes' => 'Universal donor for A and AB blood types'],
            ['name' => 'B+', 'notes' => 'Common blood type'],
            ['name' => 'B-', 'notes' => 'Universal donor for B and AB blood types'],
            ['name' => 'AB+', 'notes' => 'Universal recipient'],
            ['name' => 'AB-', 'notes' => 'Rare blood type'],
            ['name' => 'O+', 'notes' => 'Universal donor for positive blood types'],
            ['name' => 'O-', 'notes' => 'Universal donor'],
        ];

        foreach ($bloodTypes as $bloodType) {
            BloodType::create($bloodType);
        }
    }
}