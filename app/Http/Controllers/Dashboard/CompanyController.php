<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyStoreRequest;
use App\Http\Requests\Companies\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\Department;
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
            $query = Company::query()->with('departments', 'media')->latest()->get();

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
                ->editColumn('logo', function ($row) {
                    if ($row->getFirstMedia('logo')) {
                        return sprintf(
                            '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                            $row->getFirstMedia('logo')->getUrl(),
                            $row->getFirstMedia('logo')->getUrl('thumb'),
                        );
                    }
                    return '<span class="badge badge-warning">No Image</span>';
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
                ->rawColumns(['actions', 'logo', 'departments', 'created_at'])
                ->make(true);
        }

        return view('dashboard.company.index');
    }

    public function store(CompanyStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $company = Company::query()->create($request->except('departments', 'logo'));

            if ($request->hasFile('logo')) {
                $company->addMedia($request->file('logo'))->toMediaCollection('logo');
            }

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
        $departments = Department::query()->listsTranslations('name')->pluck('name', 'id');
        return view('dashboard.company.create', compact('departments'));
    }

    public function show(Company $company)
    {
        abort_if(!auth()->user()->can('show_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company->load('departments');
        $company->withTranslation();
        return view('dashboard.company.show', compact('company'));
    }

    public function edit(Company $company)
    {
        abort_if(!auth()->user()->can('edit_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company->load('departments');
        $company->withTranslation();
        $departments = Department::query()->listsTranslations('name')->pluck('name', 'id');
        return view('dashboard.company.edit', compact('company', 'departments'));
    }


    public function update(CompanyUpdateRequest $request, Company $company): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $company->update($request->except('departments', 'logo'));

            if ($request->hasFile('logo')) {
                $company->addMedia($request->file('logo'))->toMediaCollection('logo');
            }

            $company->departments()->sync($request->departments ?? []);

            DB::commit();

            Alert::success('Success', 'Company Updated Successfully');

            return redirect()->route('dashboard.companies.index');

        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
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
