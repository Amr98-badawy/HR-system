<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'access_dashboard',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_user',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_user',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_user',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_user',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_user',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_role',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_role',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_role',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_role',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_role',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_permission',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_permission',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_permission',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_permission',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_permission',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_company',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_company',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_company',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_company',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_company',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_department',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_department',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_department',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_department',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_department',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_section',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_section',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_section',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_section',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_section',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_shift',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_shift',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_shift',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_shift',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_shift',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_employee',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_employee',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_employee',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_employee',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_employee',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_attendance',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_attendance',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_attendance',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_attendance',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_attendance',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_translation',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_device',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'create_device',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'edit_device',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_device',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_device',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'access_log',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'show_log',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_log',
            'guard_name' => 'web'
        ]);
    }
}
