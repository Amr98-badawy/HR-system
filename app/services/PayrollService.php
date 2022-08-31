<?php

namespace App\services;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

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



    public function totalHourPerMonth($work_hour ,$month)
    {
        $yearData =  Attendance::selectRaw('year(created_at) as Year, monthname(created_at) as Month, count(id) as Trips')
            ->groupBy('Year','Month')
            ->orderByRaw('min(created_at) desc')
            ->get();
        $years = $yearData->pluck('Year')->toArray();

        $data['Monthly'] =  Attendance::selectRaw('year(created_at) as Year, monthname(created_at) as Month, count(id) as Trips')
            ->groupBy('Year','Month')
            ->orderByRaw('min(created_at) desc')
            ->get();
        $data['Monthly']->map(function ($item){
            $item->hour = Attendance::whereMonth('created_at', date('m',strtotime($item->Month)))
                ->whereYear('created_at',(String)$item->Year)->sum('work_hour');
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
