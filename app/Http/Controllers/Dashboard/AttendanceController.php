<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
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
                        return sprintf("<span class='badge badge-danger'>%s</span>", Carbon::make($row->delay)->format('H:i'));
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
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_attendance';
                    $deleteGate = 'delete_attendance';
                    $crudRoutePart = 'attendances';
                    $key = $row->id;
                    $show = true;

                    return view('dashboard.partials.datatable-actions-attendance', compact([
                        'showGate',
                        'deleteGate',
                        'crudRoutePart',
                        'key',
                        'show',
                    ]));
                })
                ->rawColumns(['check_in', 'check_out', 'actions', 'day_status', 'additional', 'delay', 'work_hour'])
                ->make(true);
        }

        return view('dashboard.attendance.index');
    }

    public function show(Attendance $attendance)
    {

    }

    public function destroy(Attendance $attendance)
    {
        abort_if(!auth()->user()->can('delete_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $attendance->delete();

        return redirect()->route('dashboard.attendances.index');
    }
}
