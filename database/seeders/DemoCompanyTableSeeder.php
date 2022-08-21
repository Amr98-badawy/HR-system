<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DemoCompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyOne = Company::query()->where('id',1)->first();
        $companyTwo = Company::query()->where('id',2)->first();

        $companyOne->departments()->sync([1,2,3]);
        $companyTwo->departments()->sync([4,5]);

        Department::query()->where('id',1)->first()->sections()->sync([1,3]);
        Department::query()->where('id',2)->first()->sections()->sync([2,4,5]);
        Department::query()->where('id',3)->first()->sections()->sync([5,3]);
        Department::query()->where('id',4)->first()->sections()->sync([1,4]);
        Department::query()->where('id',5)->first()->sections()->sync([2,3,4]);
    }
}
