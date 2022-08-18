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
            'name' => 'Section One',
        ]);

        Section::query()->create([
            'name' => 'Section Two',
        ]);

        Section::query()->create([
            'name' => 'Section Three',
        ]);

        Section::query()->create([
            'name' => 'Section Four',
        ]);

        Section::query()->create([
            'name' => 'Section Five',
        ]);
    }
}
