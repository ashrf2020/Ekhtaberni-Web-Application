<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Religion;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('religions')->delete();
        
        $religions = [
            ['name' => ['en' => 'Islam', 'ar' => 'الإسلام']],
            ['name' => ['en' => 'Christianity', 'ar' => 'المسيحية']],
            ['name' => ['en' => 'Judaism', 'ar' => 'اليهودية']],
            ['name' => ['en' => 'Hinduism', 'ar' => 'الهندوسية']],
            ['name' => ['en' => 'Buddhism', 'ar' => 'البوذية']],
            ['name' => ['en' => 'Sikhism', 'ar' => 'السيخية']],
            ['name' => ['en' => 'Jainism', 'ar' => 'الجاينية']],
            ['name' => ['en' => 'Zoroastrianism', 'ar' => 'الزرادشتية']],
            ['name' => ['en' => 'Baháʼí Faith', 'ar' => 'البهائية']],
            ['name' => ['en' => 'Atheism', 'ar' => 'الإلحاد']],
            ['name' => ['en' => 'Agnosticism', 'ar' => 'اللاأدرية']],
            ['name' => ['en' => 'Other', 'ar' => 'أخرى']],
        ];

        foreach ($religions as $religion) {
            Religion::create($religion);
        }
    }
}
