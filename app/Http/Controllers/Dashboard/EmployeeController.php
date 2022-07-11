<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\StoreEmployeeRequest;
use App\Http\Requests\Employees\UpdateEmployeeRequest;
use App\Models\Employee;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.employee.index');
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.employee.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        DB::beginTransaction();

        try {
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();

        }
    }

    public function show(Employee $employee)
    {
        abort_if(!auth()->user()->can('show_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        abort_if(!auth()->user()->can('edit_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.employee.edit', compact('employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        DB::beginTransaction();

        try {
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();

        }
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return redirect()->route('dashboard.employees.index');
    }
}
