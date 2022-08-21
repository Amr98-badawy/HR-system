<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::query()->create([
            'account_no' => 'CDS-747791',
            'status' => 's',
            'family_count' => null,
            'first_name' => 'Joe',
            'second_name' => 'Dixon',
            'family_name' => 'Martin',
            'gender' => 'm',
            'job_title' => 'Project Manager',
            'date_of_birth' => '1990-06-12',
            'id_card' => '020202020202020',
            'address' => 'AB Agha Khan floor 23',
            'mobile' => '00000000000',
            'date_of_employment' => '2022-08-01',
            'office_tel' => '26',
            'nationality' => 'Egyptian',
            'company_id' => 1,
            'department_id' => 5,
            'section_id' => 1,
            'salary' => 40000,
            'bank_account' => '00000000000',
            'shift_id' => 1,
            'device_number' => 'samsung-a23'
        ]);
    }
}
