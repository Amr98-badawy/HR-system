<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::query()->create([
            'name' => 'HR Department'
        ]);

        Department::query()->create([
            'name' => 'Accounting Department'
        ]);

        Department::query()->create([
            'name' => 'Inventory Department'
        ]);

        Department::query()->create([
            'name' => 'Marketing Department'
        ]);

        Department::query()->create([
            'name' => 'Development Department'
        ]);
    }
}
