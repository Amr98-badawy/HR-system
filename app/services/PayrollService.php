<?php

namespace App\services;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PayrollService
{
    public function salaryPerHour($from, $to,$salary)
    {
        $startTime = Carbon::parse($from);
        $endTime = Carbon::parse($to);
        $totalWorkHour = intval(gmdate('H',$endTime->diffInSeconds($startTime))) * 30;
        $salaryBerHour = $salary / $totalWorkHour;
        return $salaryBerHour;
    }



//    public function totalHourPerDay()
//    {
//
//    }



//    public function additionalHourPerDay()
//    {
//
//    }


//    public function deductedHourPerDay()
//    {
//
//    }



    public function totalHourPerMonth($month)
    {
//        $month = '08';
        $data = Attendance::whereMonth('created_at', $month)
            ->selectRaw('year(created_at) as Year, monthname(created_at) as Month')
            ->groupBy('Year', 'Month')
            ->orderByRaw('min(created_at) desc')
            ->get();
        $data->map(function ($item) {
            $item->hours = Attendance::whereMonth('created_at', date('m', strtotime($item->Month)))
                ->whereYear('created_at', (string)$item->Year)->sum(DB::raw('HOUR(work_hour)'));

            unset($item->Year);
            unset($item->Month);
            unset($item->SEC);

        });
        return $data;
    }

        public function totalSalaryPerHour()
    {

    }

    public function totalAdditionalSalary()
    {

    }

    public function totalDeductedSalary()
    {

    }

    public function totalAdditionalHour()
    {

    }

    public function totalDeductedHour()
    {

    }



}
