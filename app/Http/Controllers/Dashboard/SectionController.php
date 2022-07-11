<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sections\StoreSectionRequest;
use App\Http\Requests\Sections\UpdateSectionRequest;
use App\Models\Department;
use App\Models\Section;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_section'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Section::query()->with('department')->latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_section';
                    $editGate = 'edit_section';
                    $deleteGate = 'delete_section';
                    $crudRoutePart = 'sections';
                    $key = $row->id;
                    $show = false;

                    return view('dashboard.partials.datatable-actions', compact([
                        'showGate',
                        'editGate',
                        'deleteGate',
                        'crudRoutePart',
                        'key',
                        'show',
                    ]));
                })
                ->editColumn('department', function ($row) {
                    if ($row->department) {
                        return sprintf('<span class="badge badge-primary">%s</span>', $row->department->name);
                    }
                    return '';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('Md Y') : '';
                })
                ->rawColumns(['actions', 'department', 'created_at'])
                ->make(true);
        }

        return view('dashboard.section.index');
    }

    public function store(StoreSectionRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            Section::query()->create($request->validated());

            DB::commit();

            Alert::success('Success', 'Section Created Successfully');

            return redirect()->route('dashboard.sections.index');

        } catch (Exception $e) {
            DB::rollBack();

            Alert::error('Error', 'Something went wrong, please try again');

            return redirect()->route('dashboard.sections.index');
        }
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create_section'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $departments = Department::query()->listsTranslations('name')->pluck('name', 'id');
        return view('dashboard.section.create', compact('departments'));
    }

    public function show(Section $section)
    {
        abort_if(!auth()->user()->can('show_section'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('dashboard.section.show', compact('section'));
    }

    public function edit(Section $section)
    {
        abort_if(!auth()->user()->can('create_section'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $section->load('department');
        $departments = Department::query()->listsTranslations('name')->pluck('name', 'id');
        return view('dashboard.section.edit', compact('section', 'departments'));
    }

    public function update(UpdateSectionRequest $request, Section $section): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $section->update($request->validated());

            DB::commit();

            Alert::success('Success', 'Section Updated Successfully');

            return redirect()->route('dashboard.sections.index');

        } catch (Exception $e) {
            DB::rollBack();

            Alert::error('Error', 'Something went wrong, please try again');

            return redirect()->route('dashboard.sections.index');
        }
    }

    public function destroy(Section $section): RedirectResponse
    {
        $section->delete();

        Alert::warning('Warning', 'Record Deleted Successfully');

        return redirect()->route('dashboard.sections.index');
    }
}
