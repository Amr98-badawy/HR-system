<?php

namespace Database\Seeders;

use App\Models\SiteLanguage;
use Illuminate\Database\Seeder;

class SiteLanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteLanguage::create([
            'name' => 'English',
            'locale' => 'en',
        ]);

        SiteLanguage::create([
            'name' => 'العربية',
            'locale' => 'ar',
        ]);
    }
}
