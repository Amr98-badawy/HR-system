<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PayRoll;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PayRollController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_payroll'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = PayRoll::with('employee')->latest()->get();
            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_payroll';
                    $editGate = 'edit_payroll';
                    $deleteGate = 'delete_payroll';
                    $crudRoutePart = 'payroll';
                    $key = $row->payroll_no;
                    $show = true;

                    return view('dashboard.partials.datatable-actions', compact([
                        'showGate',
                        'editGate',
                        'deleteGate',
                        'crudRoutePart',
                        'key',
                        'show',
                    ]));
                })
                ->editColumn('employee_name', function ($row) {
                    if ($row->employee->fullName) {
                        return $row->employee->fullName;
                    }
                    return '';
                })
                ->rawColumns(['employee_name', 'actions'])
                ->make(true);
        }
        return view('dashboard.payroll.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
