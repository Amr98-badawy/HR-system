<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::query()->create([
            'en' => [
                'name' => 'Company One'
            ],
            'ar' => [
                'name' => 'الشركة الأولي'
            ],
        ]);

        Company::query()->create([
            'en' => [
                'name' => 'Company Two'
            ],
            'ar' => [
                'name' => 'الشركة الثانية'
            ],
        ]);
    }
}
