<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'Super Admin',
            'email' => 'super-admin@limitlesscode.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now()->toString(),
        ]);
    }
}
