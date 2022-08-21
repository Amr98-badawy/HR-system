<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::query()->create([
            'name' => 'Company One'
        ]);

        Company::query()->create([
            'name' => 'Company Two'
        ]);
    }
}
