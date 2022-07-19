<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\LanguageStoreRequest;
use App\Http\Requests\Languages\LanguageUpdateRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\SiteLanguage;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SiteLanguageController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_language'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = SiteLanguage::latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_language';
                    $editGate = 'edit_language';
                    $deleteGate = 'delete_language';
                    $crudRoutePart = 'languages';
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
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('dashboard.language.index');
    }

    public function store(LanguageStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            SiteLanguage::query()->create([
                'name' => $request->name,
                'locale' => $request->lang_locale,
            ]);

            DB::commit();

            Alert::success('success', 'Record created successfully');

            return redirect()->route('dashboard.languages.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong please try again');
            return redirect()->route('dashboard.languages.index');
        }
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create_language'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.language.create');
    }

    public function show(SiteLanguage $language)
    {
        abort_if(!auth()->user()->can('show_language'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.languages.show', compact('language'));
    }

    public function edit(SiteLanguage $language)
    {
        abort_if(!auth()->user()->can('edit_language'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.language.edit', compact([
            'language',
        ]));
    }

    public function update(LanguageUpdateRequest $request, SiteLanguage $language): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $language->update([
                'name' => $request->name,
                'locale' => $request->lang_locale,
            ]);

            DB::commit();

            Alert::success('success', 'Record Updated successfully');

            return redirect()->route('dashboard.languages.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong please try again');
            return redirect()->route('dashboard.languages.index');
        }
    }

    public function destroy(SiteLanguage $language): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_language'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $language->delete();

        Alert::warning('Warning', 'Record Deleted Successfully');

        return redirect()->route('dashboard.languages.index');
    }
}
