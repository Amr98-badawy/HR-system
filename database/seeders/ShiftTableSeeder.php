<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::query()->create([
            'name' => 'Morning Shift',
            'from' => '09:00:00',
            'to' => '17:00:00',
            'extra_time' => '09:30:00',
            'active' => true,
        ]);

        Shift::query()->create([
            'name' => 'Midnight Shift',
            'from' => '17:00:00',
            'to' => '00:00:00',
            'extra_time' => '17:30:00',
            'active' => true,
        ]);
    }
}
