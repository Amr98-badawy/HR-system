<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Company;
use App\Models\Employee;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class DashboardPageController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->can('access_dashboard'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies_count = Company::query()->count();
        $employees_count = Employee::query()->count();

        $attendances = Attendance::with('employee.company', 'employee.shift')
            ->whereDate('created_at', Carbon::today())
            ->whereNotNull('check_in')
            ->latest()
            ->limit(10)
            ->get();

        $attendanceCheckout = Attendance::with('employee.company', 'employee.shift')
            ->whereDate('created_at', Carbon::today())
            ->whereNotNull('check_in')
            ->whereNotNull('check_out')
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard.site.home', compact([
            'companies_count',
            'employees_count',
            'attendances',
            'attendanceCheckout',
        ]));
    }
}
