<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyStoreRequest;
use App\Http\Requests\Companies\CompanyUpdateRequest;
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

class CompanyController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Company::query()->with('departments')->latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_company';
                    $editGate = 'edit_company';
                    $deleteGate = 'delete_company';
                    $crudRoutePart = 'companies';
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
                ->editColumn('departments', function ($row) {
                    if ($row->departments) {
                        $links = [];
                        foreach ($row->departments as $item) {
                            $links[] = sprintf('<span class="badge badge-primary">%s</span>', $item->name);
                        }
                        return implode(' ', $links);
                    }
                    return '';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('Md Y') : '';
                })
                ->rawColumns(['actions', 'departments', 'created_at'])
                ->make(true);
        }

        return view('dashboard.company.index');
    }

    public function store(CompanyStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $company = Company::query()->create($request->except('departments'));

            $company->departments()->sync($request->departments ?? []);

            DB::commit();

            Alert::success('Success', 'Company Created Successfully');

            return redirect()->route('dashboard.companies.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.companies.index');
        }
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $departments = Department::query()->withTranslation()->get();
        return view('dashboard.company.create', compact('departments'));
    }

    public function show(Company $company)
    {
        abort_if(!auth()->user()->can('show_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company->withTranslation();
        return view('dashboard.company.show', compact('company'));
    }

    public function edit(Company $company)
    {
        abort_if(!auth()->user()->can('edit_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company->load('departments');
        $company->withTranslation();
        $departments = Department::query()->withTranslation()->get();
        return view('dashboard.company.edit', compact('company', 'departments'));
    }


    public function update(CompanyUpdateRequest $request, Company $company): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $company->update($request->except('departments'));

            $company->departments()->sync($request->departments ?? []);

            DB::commit();

            Alert::success('Success', 'Company Updated Successfully');

            return redirect()->route('dashboard.companies.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.companies.index');
        }
    }

    public function destroy(Company $company): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->delete();

        Alert::warning('Warning', 'Company Deleted Successfully');

        return redirect()->route('dashboard.companies.index');
    }
}
