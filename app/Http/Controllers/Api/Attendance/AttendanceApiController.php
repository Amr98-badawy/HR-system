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
                ->where('created_at', '>=', now()->today())
                ->whereNotNull('check_in')
                ->whereNull('check_out')
                ->first();

            if ($checkedIn) {
                return response(['msg' => 'You are already checked in'], Response::HTTP_OK);
            }

            $attendance = Attendance::query()->create([
                'employee_id' => $employee->id,
                'day_status' => 'wd',
                'check_in' => now()->format('H:i:s'),
            ]);

            $shift = Carbon::parse($employee->shift->extra_time);
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
        $attendance->load('employee.shift');
        $now = Carbon::now();

        if ($attendance->check_out != null) {
            return response(['message' => 'You are already checked out'], Response::HTTP_OK);
        }

        $shift = Carbon::parse($attendance->employee->shift->to);
        $checkOut = Carbon::parse(Carbon::now()->format("H:i:s"));
        $additionalTime = $shift->diff($checkOut)->format('%H:%i:%s');
        $checkIn = Carbon::parse($attendance->check_in);
        $work_hour = $checkOut->diff($checkIn)->format('%H:%i:%s');

        if ($now->gt($attendance->employee->shift->to)) {
            $attendance->update([
                'check_out' => Carbon::now()->format('H:i:s'),
                'work_hour' => $work_hour,
                'additional_time' => $additionalTime
            ]);

            $attendance->update([
                'work_hour' => $work_hour
            ]);

            return response(['message' => 'You are checked out now'], Response::HTTP_OK);
        } else {
            $attendance->update([
                'check_out' => Carbon::now()->format('H:i:s'),
                'work_hour' => $work_hour,
                'additional' => null
            ]);

            return response(['message' => 'You are checked out now'], Response::HTTP_OK);
        }

    }
}
