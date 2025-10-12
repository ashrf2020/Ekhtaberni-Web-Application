<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nationality;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nationalities')->delete();
        
        $nationalities = [
            ['name' => ['en' => 'Saudi', 'ar' => 'سعودي']],
            ['name' => ['en' => 'Egyptian', 'ar' => 'مصري']],
            ['name' => ['en' => 'Jordanian', 'ar' => 'أردني']],
            ['name' => ['en' => 'Palestinian', 'ar' => 'فلسطيني']],
            ['name' => ['en' => 'Lebanese', 'ar' => 'لبناني']],
            ['name' => ['en' => 'Syrian', 'ar' => 'سوري']],
            ['name' => ['en' => 'Iraqi', 'ar' => 'عراقي']],
            ['name' => ['en' => 'Kuwaiti', 'ar' => 'كويتي']],
            ['name' => ['en' => 'Emirati', 'ar' => 'إماراتي']],
            ['name' => ['en' => 'Qatari', 'ar' => 'قطري']],
            ['name' => ['en' => 'Bahraini', 'ar' => 'بحريني']],
            ['name' => ['en' => 'Omani', 'ar' => 'عماني']],
            ['name' => ['en' => 'Yemeni', 'ar' => 'يمني']],
            ['name' => ['en' => 'Sudanese', 'ar' => 'سوداني']],
            ['name' => ['en' => 'Moroccan', 'ar' => 'مغربي']],
            ['name' => ['en' => 'Algerian', 'ar' => 'جزائري']],
            ['name' => ['en' => 'Tunisian', 'ar' => 'تونسي']],
            ['name' => ['en' => 'Libyan', 'ar' => 'ليبي']],
            ['name' => ['en' => 'American', 'ar' => 'أمريكي']],
            ['name' => ['en' => 'British', 'ar' => 'بريطاني']],
            ['name' => ['en' => 'French', 'ar' => 'فرنسي']],
            ['name' => ['en' => 'German', 'ar' => 'ألماني']],
            ['name' => ['en' => 'Italian', 'ar' => 'إيطالي']],
            ['name' => ['en' => 'Spanish', 'ar' => 'إسباني']],
            ['name' => ['en' => 'Canadian', 'ar' => 'كندي']],
            ['name' => ['en' => 'Australian', 'ar' => 'أسترالي']],
            ['name' => ['en' => 'Indian', 'ar' => 'هندي']],
            ['name' => ['en' => 'Pakistani', 'ar' => 'باكستاني']],
            ['name' => ['en' => 'Bangladeshi', 'ar' => 'بنغلاديشي']],
            ['name' => ['en' => 'Filipino', 'ar' => 'فلبيني']],
            ['name' => ['en' => 'Indonesian', 'ar' => 'إندونيسي']],
            ['name' => ['en' => 'Malaysian', 'ar' => 'ماليزي']],
            ['name' => ['en' => 'Thai', 'ar' => 'تايلندي']],
            ['name' => ['en' => 'Vietnamese', 'ar' => 'فيتنامي']],
            ['name' => ['en' => 'Chinese', 'ar' => 'صيني']],
            ['name' => ['en' => 'Japanese', 'ar' => 'ياباني']],
            ['name' => ['en' => 'Korean', 'ar' => 'كوري']],
            ['name' => ['en' => 'Turkish', 'ar' => 'تركي']],
            ['name' => ['en' => 'Iranian', 'ar' => 'إيراني']],
            ['name' => ['en' => 'Afghan', 'ar' => 'أفغاني']],
            ['name' => ['en' => 'Other', 'ar' => 'أخرى']],
        ];

        foreach ($nationalities as $nationality) {
            Nationality::create($nationality);
        }
    }
}
