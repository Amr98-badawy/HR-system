<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\PermissionStoreRequest;
use App\Http\Requests\Permissions\PermissionUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_permission'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Permission::latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_permission';
                    $editGate = 'edit_permission';
                    $deleteGate = 'delete_permission';
                    $crudRoutePart = 'permissions';
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
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('Md Y') : '';
                })
                ->rawColumns(['actions', 'created_at',])
                ->make(true);
        }

        return view('dashboard.permissions.index');
    }

    public function store(PermissionStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            Permission::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);

            DB::commit();

            Alert::success('Success', 'Permission Created Successfully');

            return redirect()->route('dashboard.permissions.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.permissions.index');
        }
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create_permission'),Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('dashboard.permissions.create');
    }

    public function edit(Permission $permission)
    {
        abort_if(!auth()->user()->can('edit_permission'),Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('dashboard.permissions.edit', compact('permission'));
    }

    public function update(PermissionUpdateRequest $request, Permission $permission): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $permission->update([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);

            DB::commit();

            Alert::success('Success', 'Permission Updated Successfully');

            return redirect()->route('dashboard.permissions.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.permissions.index');
        }
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_permission'),Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permission->delete();

        Alert::warning('Warning', 'Permission Deleted Successfully');

        return redirect()->route('dashboard.permissions.index');
    }
}
