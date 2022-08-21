<?php

namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements FromView
{
    use Exportable;

    public $startDate;
    public $endDate;
    public $employeeId;

    public function __construct($employeeId, $startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->employeeId = $employeeId;
    }

    public function view(): View
    {
        if ($this->employeeId) {
            $attendances = Attendance::query()
                ->with('employee.company', 'employee.department', 'employee.section', 'employee.shift')
                ->where('employee_id', $this->employeeId)
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->get();
            return view('dashboard.exports.attendance-employee', compact('attendances'));
        }

        $attendances = Attendance::query()
            ->with('employee.company', 'employee.department', 'employee.section', 'employee.shift')
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->get();

        return view('dashboard.exports.attendance', compact('attendances'));
    }
}
