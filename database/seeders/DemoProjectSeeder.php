<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DemoPermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(ShiftTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(DemoCompanyTableSeeder::class);
        $this->call(DemoAttendanceTableSeeder::class);
    }
}
