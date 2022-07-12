<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\StoreEmployeeRequest;
use App\Http\Requests\Employees\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Section;
use App\Models\Shift;
use App\Traits\GenerateUniqueCodeTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    use GenerateUniqueCodeTrait;

    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Employee::query()->with(['media', 'company.translations', 'department.translations', 'section.translations', 'shift'])->latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_employee';
                    $editGate = 'edit_employee';
                    $deleteGate = 'delete_employee';
                    $crudRoutePart = 'employees';
                    $key = $row->slug;
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
                ->editColumn('name', function ($row) {
                    if ($row->first_name && $row->second_name && $row->family_name) {
                        return "{$row->first_name} {$row->second_name} {$row->family_name}";
                    }
                    return '';
                })
                ->editColumn('company', function ($row) {
                    if ($row->company) {
                        return $row->company->name;
                    }
                    return '';
                })
                ->editColumn('department', function ($row) {
                    if ($row->section) {
                        return $row->department->name;
                    }
                    return '';
                })
                ->editColumn('section', function ($row) {
                    if ($row->section) {
                        return $row->section->name;
                    }
                    return '';
                })
                ->editColumn('shift', function ($row) {
                    if ($row->shift) {
                        return $row->shift->name;
                    }
                    return '';
                })
                ->editColumn('date_of_employment', function ($row) {
                    if ($row->shift) {
                        return $row->date_of_employment->format('M d Y');
                    }
                    return '';
                })
                ->editColumn('salary', function ($row) {
                    if ($row->salary) {
                        return $row->salary . 'EGP';
                    }
                    return '';
                })
                ->editColumn('office_tel', function ($row) {
                    if ($row->office_tel) {
                        return sprintf(
                            '<a href="tel:%s">%s</a>',
                            $row->office_tel,
                            $row->office_tel
                        );
                    }
                    return '';
                })
                ->editColumn('photo', function ($row) {
                    if ($row->getFirstMedia('photo')) {
                        return sprintf(
                            '<a href="%s" target="_blank"><img class="rounded-50" src="%s" width="50px" height="50px"></a>',
                            $row->getFirstMedia('photo')->getUrl(),
                            $row->getFirstMedia('photo')->getUrl('thumb'),
                        );
                    }
                    return sprintf(
                        '<a href="%s" target="_blank"><img class="rounded-50" src="%s" width="50px" height="50px"></a>',
                        asset('assets/img/Avatar/user-avatar.png'),
                        asset('assets/img/Avatar/user-avatar.png'),
                    );
                })
                ->rawColumns(['photo', 'company', 'department', 'section', 'shift', 'date_of_employment', 'office_tel', 'salary', 'actions'])
                ->make(true);
        }

        return view('dashboard.employee.index');
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $company = Company::query()->whereTranslation('company_id', $request->company_id)
                ->listsTranslations('name')
                ->pluck('name')
                ->first()[0];
            $department = Department::query()->whereTranslation('department_id', $request->department_id)
                ->listsTranslations('name')
                ->pluck('name')
                ->first()[0];
            $section = Section::query()->whereTranslation('section_id', $request->section_id)
                ->listsTranslations('name')
                ->pluck('name')
                ->first()[0];

            $str = "{$company}{$department}{$section}";

            $employee = Employee::query()->create([
                'slug' => $request->slug,
                'account_no' => $this->generateUniqueCode($str, new Employee(), 'account_no', 100, 999999),
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'family_name' => $request->family_name,
                'gender' => $request->gender,
                'job_title' => $request->job_title,
                'date_of_birth' => $request->date_of_birth,
                'id_card' => $request->id_card,
                'address' => $request->address,
                'mobile' => $request->mobile,
                'date_of_employment' => $request->date_of_employment,
                'office_tel' => $request->office_tel,
                'nationality' => $request->nationality,
                'company_id' => $request->company_id,
                'department_id' => $request->department_id,
                'section_id' => $request->section_id,
                'shift_id' => $request->shift_id,
                'bank_account' => $request->bank_account,
                'salary' => $request->salary,
            ]);

            if ($request->hasFile('photo')) {
                $employee->addMedia($request->file('photo'))->toMediaCollection('photo');
            }

            if ($request->hasFile('military_status')) {
                $employee->addMedia($request->file('military_status'))->toMediaCollection('military_status');
            }

            if ($request->hasFile('criminal_record')) {
                $employee->addMedia($request->file('criminal_record'))->toMediaCollection('criminal_record');
            }

            if ($request->hasFile('collage_certificate')) {
                $employee->addMedia($request->file('collage_certificate'))->toMediaCollection('collage_certificate');
            }

            if ($request->hasFile('birth_certificate')) {
                $employee->addMedia($request->file('birth_certificate'))->toMediaCollection('birth_certificate');
            }

            if ($request->hasFile('additional_files')) {
                foreach ($request->file('additional_files') as $item) {
                    $employee->addMedia($item)->toMediaCollection('additional_files');
                }
            }

            DB::commit();
            Alert::success('Success', 'Employee Created successfully');
            return redirect()->route('dashboard.employees.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, Please try again');
            return redirect()->route('dashboard.employees.index');
        }
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $companies = Company::query()->listsTranslations('name')->pluck('name', 'id');
        $departments = Department::query()->listsTranslations('name')->pluck('name', 'id');
        $sections = Section::query()->listsTranslations('name')->pluck('name', 'id');
        $shifts = Shift::query()->pluck('name', 'id');
        return view('dashboard.employee.create', compact([
            'departments',
            'companies',
            'sections',
            'shifts',
        ]));
    }

    public function show(Employee $employee)
    {
        abort_if(!auth()->user()->can('show_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee->load(['department.translations', 'section.translations', 'company.translations', 'shift', 'media']);
        return view('dashboard.employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        abort_if(!auth()->user()->can('edit_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $companies = Company::query()->listsTranslations('name')->pluck('name', 'id');
        $departments = Department::query()->listsTranslations('name')->pluck('name', 'id');
        $sections = Section::query()->listsTranslations('name')->pluck('name', 'id');
        $shifts = Shift::query()->pluck('name', 'id');
        $employee->load(['department.translations', 'section.translations', 'company.translations', 'shift']);
        return view('dashboard.employee.edit', compact([
            'employee',
            'departments',
            'companies',
            'sections',
            'shifts',
        ]));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $employee->update([
                'slug' => Str::slug("{$request->first_name} {$request->second_name} {$request->family_name}"),
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'family_name' => $request->family_name,
                'gender' => $request->gender,
                'job_title' => $request->job_title,
                'date_of_birth' => $request->date_of_birth,
                'id_Card' => $request->id_Card,
                'address' => $request->address,
                'mobile' => $request->mobile,
                'date_of_employment' => $request->date_of_employment,
                'office_tel' => $request->office_tel,
                'nationality' => $request->nationality,
                'company_id' => $request->company_id,
                'department_id' => $request->department_id,
                'section_id' => $request->section_id,
                'shift_id' => $request->shift_id,
                'bank_account' => $request->bank_account,
                'salary' => $request->salary,
            ]);

            if ($request->hasFile('photo')) {
                $employee->addMedia($request->file('photo'))->toMediaCollection('photo');
            }

            if ($request->hasFile('military_status')) {
                $employee->addMedia($request->file('military_status'))->toMediaCollection('military_status');
            }

            if ($request->hasFile('criminal_record')) {
                $employee->addMedia($request->file('criminal_record'))->toMediaCollection('criminal_record');
            }

            if ($request->hasFile('collage_certificate')) {
                $employee->addMedia($request->file('collage_certificate'))->toMediaCollection('collage_certificate');
            }

            if ($request->hasFile('birth_certificate')) {
                $employee->addMedia($request->file('birth_certificate'))->toMediaCollection('birth_certificate');
            }

            if ($request->hasFile('additional_files')) {
                foreach ($request->file('additional_files') as $item) {
                    $employee->addMedia($item)->toMediaCollection('additional_files');
                }
            }

            DB::commit();
            Alert::success('Success', 'Employee updated successfully');
            return redirect()->route('dashboard.employees.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, Please try again');
            return redirect()->route('dashboard.employees.index');
        }
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee->delete();
        return redirect()->route('dashboard.employees.index');
    }
}
