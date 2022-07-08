<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyStoreRequest;
use App\Http\Requests\Companies\CompanyUpdateRequest;
use App\Models\Company;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{

    public function index()
    {
        abort_if(!auth()->user()->can('access_company'),Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function store(CompanyStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            Company::query()->create($request->validated());

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
        abort_if(!auth()->user()->can('create_company'),Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('dashboard.company.create');
    }

    public function show(Company $company)
    {
        abort_if(!auth()->user()->can('show_company'),Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company->withTranslation();
        return view('dashboard.company.show', compact('company'));
    }

    public function edit(Company $company)
    {
        abort_if(!auth()->user()->can('edit_company'),Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company->withTranslation();
        return view('dashboard.company.edit', compact('company'));
    }


    public function update(CompanyUpdateRequest $request, Company $company): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $company->update($request->validated());

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
        abort_if(!auth()->user()->can('delete_company'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->delete();

        Alert::warning('Warning', 'Company Deleted Successfully');

        return redirect()->route('dashboard.companies.index');
    }
}
