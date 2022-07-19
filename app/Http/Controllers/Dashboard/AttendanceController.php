<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_attendance'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Attendance::with('employee', 'employee.department', 'employee.section')->latest()->get();

            return DataTables::of($query)
                ->editColumn('name', function ($row) {
                    return $row->employee->fullName ?? '';
                })
                ->editColumn('department', function ($row) {
                    return $row->employee->department->name ?? '';
                })
                ->editColumn('section', function ($row) {
                    return $row->employee->section->name ?? '';
                })
                ->editColumn('day_status', function ($row) {
                    if ($row->day_status) {
                        return sprintf(
                            '<span class="badge badge-primary">%s</span>',
                            Attendance::DAY_STATUS[$row->day_status]
                        );
                    }
                    return '';
                })
                ->editColumn('check_in', function ($row) {
                    if ($row->check_in) {
                        return Carbon::make($row->check_in)->format('h:i A');
                    }
                    return '';
                })
                ->editColumn('check_out', function ($row) {
                    if ($row->check_out) {
                        return Carbon::make($row->check_out)->format('h:i A');
                    }
                    return '';
                })
                ->editColumn('work_hour', function ($row) {
                    if ($row->check_out) {
                        return Carbon::make($row->work_hour)->format('h:i A');
                    }
                    return '';
                })
                ->editColumn('delay', function ($row) {
                    if ($row->delay) {
                        return Carbon::make($row->delay)->format('h:i A');
                    }
                    return '';
                })
                ->editColumn('additional', function ($row) {
                    if ($row->additional) {
                        return Carbon::make($row->additional)->format('h:i A');
                    }
                    return '';
                })
                ->editColumn('note', function ($row) {
                    if ($row->note) {
                        return $row->note;
                    }
                    return '';
                })
//                ->addColumn('actions', function ($row) {
//                    $showGate = 'show_attendance';
//                    $editGate = 'edit_attendance';
//                    $deleteGate = 'delete_attendance';
//                    $crudRoutePart = 'attendances';
//                    $key = $row->id;
//                    $show = false;
//
//                    return view('dashboard.partials.datatable-actions', compact([
//                        'showGate',
//                        'editGate',
//                        'deleteGate',
//                        'crudRoutePart',
//                        'key',
//                        'show',
//                    ]));
//                })
//                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('dashboard.attendance.index');
    }

    public function setCheckIn(Employee $employee)
    {
        Attendance::query()->create([
            'employee_id' => $employee->id,
            'day_status' => 'wd',
            'check_in' => now()->format('H:i:s'),
        ]);
    }
}
