<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Departments\DepartmentStoreRequest;
use App\Http\Requests\Departments\DepartmentUpdateRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Department::query()->withTranslation()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_department';
                    $editGate = 'edit_department';
                    $deleteGate = 'delete_department';
                    $crudRoutePart = 'departments';
                    $key = $row->id;
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
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('Md Y') : '';
                })
                ->rawColumns(['actions', 'created_at'])
                ->make(true);
        }

        return view('dashboard.department.index');
    }

    public function store(DepartmentStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $department = Department::query()->create($request->except('companies'));

            $department->companies()->sync($request->companies ?? []);

            DB::commit();

            Alert::success('Success', 'Department Created Successfully');

            return redirect()->route('dashboard.departments.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.departments.index');
        }
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $companies = Company::query()->listsTranslations('name')->pluck('name','id');
        return view('dashboard.department.create', compact('companies'));
    }

    public function show(Department $department)
    {
        abort_if(!auth()->user()->can('show_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $department->load('companies');
        return view('dashboard.department.show', compact('department'));
    }

    public function edit(Department $department)
    {
        abort_if(!auth()->user()->can('edit_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $department->load('companies');
        $companies = Company::query()->listsTranslations('name')->pluck('name','id');
        return view('dashboard.department.edit', compact([
            'department',
            'companies'
        ]));
    }

    public function update(DepartmentUpdateRequest $request, Department $department): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $department->update($request->except('companies'));

            $department->companies()->sync($request->companies ?? []);

            DB::commit();

            Alert::success('Success', 'Department Updated Successfully');

            return redirect()->route('dashboard.departments.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.departments.index');
        }
    }

    public function destroy(Department $department): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $department->delete();
        Alert::warning('Warning', 'Record Deleted Successfully');
        return redirect()->route('dashboard.departments.index');
    }
}
