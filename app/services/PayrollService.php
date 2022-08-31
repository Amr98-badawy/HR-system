<?php

namespace App\services;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class PayrollService
{
    public function salaryPerHour(Employee $employee)
    {
        $startTime = Carbon::parse($employee->shift->from);
        $endTime = Carbon::parse($employee->shift->to);
        $totalWorkHour = intval(gmdate('H',$endTime->diffInSeconds($startTime))) * 30;
        $salaryBerHour = $employee->salary / $totalWorkHour;
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



    public function totalHourPerMonth(Attendance $attendance)
    {
//        $data = $attendance->
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
