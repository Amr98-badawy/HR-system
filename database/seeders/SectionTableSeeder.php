<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::query()->create([
            'en' => [
                'name' => 'Section One'
            ],
            'ar' => [
                'name' => 'قسم الأول'
            ],
            'department_id' => 1
        ]);

        Section::query()->create([
            'en' => [
                'name' => 'Section Two'
            ],
            'ar' => [
                'name' => 'قسم الثاني'
            ],
            'department_id' => 2
        ]);

        Section::query()->create([
            'en' => [
                'name' => 'Section Three'
            ],
            'ar' => [
                'name' => 'قسم الثالث'
            ],
            'department_id' => 3
        ]);

        Section::query()->create([
            'en' => [
                'name' => 'Section Four'
            ],
            'ar' => [
                'name' => 'قسم الرابع'
            ],
            'department_id' => 4
        ]);

        Section::query()->create([
            'en' => [
                'name' => 'Section Five'
            ],
            'ar' => [
                'name' => 'قسم الخامس'
            ],
            'department_id' => 5
        ]);
    }
}
