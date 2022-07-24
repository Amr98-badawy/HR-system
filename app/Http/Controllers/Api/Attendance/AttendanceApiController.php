<?php

namespace App\Http\Controllers\Api\Attendance;

use App\Http\Controllers\Controller;
use App\Http\Resources\Attendance\AttendanceCheckInResource;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class AttendanceApiController extends Controller
{
    public function setCheckIn(Employee $employee)
    {
        try {
            $employee->load('shift');

            $checkedIn = Attendance::query()->where('employee_id', $employee->id)
                ->where('created_at', '>=', now())
                ->whereNotNull('check_in')
                ->whereNull('check_out')
                ->first();

            if (!$checkedIn) {
                return response(['msg' => 'You are already checked in'], Response::HTTP_OK);
            }

            $attendance = Attendance::query()->create([
                'employee_id' => $employee->id,
                'day_status' => 'wd',
                'check_in' => now()->format('H:i:s'),
            ]);

            $shift = Carbon::parse($employee->shift->from);
            $checkIn = Carbon::parse($attendance->check_in);
            $delay = $shift->diff($checkIn)->format('%H:%i:%s');


            $attendance->update([
                'delay' => Carbon::make($delay)->format('H:i:s')
            ]);

            return AttendanceCheckInResource::make($attendance)
                ->additional(['message' => 'You checked in successfully'])
                ->response()
                ->setStatusCode(200);

        } catch (Exception $e) {
            return response(['msg' => 'Something went wrong, please try again'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function setCheckOut(Attendance $attendance)
    {
        
    }
}
