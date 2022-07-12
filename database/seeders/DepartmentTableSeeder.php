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
            'en' => [
                'name' => 'HR Department'
            ],
            'ar' => [
                'name' => 'قسم الأتش أر'
            ],
        ]);

        Department::query()->create([
            'en' => [
                'name' => 'Accounting Department'
            ],
            'ar' => [
                'name' => 'قسم الحسابات'
            ],
        ]);

        Department::query()->create([
            'en' => [
                'name' => 'Inventory Department'
            ],
            'ar' => [
                'name' => 'قسم المخازن'
            ],
        ]);

        Department::query()->create([
            'en' => [
                'name' => 'Marketing Department'
            ],
            'ar' => [
                'name' => 'قسم التسويق'
            ],
        ]);

        Department::query()->create([
            'en' => [
                'name' => 'Development Department'
            ],
            'ar' => [
                'name' => 'قسم البرمجة'
            ],
        ]);
    }
}
