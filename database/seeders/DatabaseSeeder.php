<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(SiteLanguageTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(ShiftTableSeeder::class);
    }
}
