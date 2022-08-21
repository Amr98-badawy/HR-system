<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->create([
            'name' => 'Super Admin',
            'email' => 'super-admin@vodex-co.com',
            'password' => Hash::make('vodex@super-admin'),
            'email_verified_at' => now()->toString(),
        ]);

        $role = Role::where('name', 'super-admin')->first();

        $user->assignRole($role);
    }
}
