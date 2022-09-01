<?php

namespace App\services;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PayrollService
{
    public function salaryPerHour()
    {
        $from = '09:00:00';
        $to = '17:00:00';
        $salary = 7000;

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



    public function totalHourPerMonth()
    {
        $month = '08';
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


    public function totalSalaryPerMonth()
    {

        $totalHourPerMonth = $this->totalHourPerMonth();
        $totalHour = $totalHourPerMonth[0]->hours + 80;
        $salary = $this->salaryPerHour();
        $total = $totalHour * $salary ;


        return (int)$total ;

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
