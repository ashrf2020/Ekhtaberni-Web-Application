<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BloodType;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call([
            BloodTypeSeeder::class,
            NationalitySeeder::class,
            ReligionSeeder::class,
            GenderSeeder::class,
            SpecializationSeeder::class,
            SettingsTableSeeder::class,
        ]);
    }
}