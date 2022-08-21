<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::query()->create([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);

        $permissions = Permission::all();

        $role->syncPermissions($permissions->pluck('id'));
    }
}
