<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\RoleStoreRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Role::withCount('permissions')->where(function ($query) {
                if (!auth()->user()->hasRole('super-admin')) {
                    $query->where('name', '!=', 'super-admin');
                }
            })->latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_role';
                    $editGate = 'edit_role';
                    $deleteGate = 'delete_role';
                    $crudRoutePart = 'roles';
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
                ->editColumn('permissions_count', function ($row) {
                    if ($row->permissions_count) {
                        return sprintf("<span class='badge badge-warning'>%s</span>", $row->permissions_count);
                    }
                    return '';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('Md Y') : '';
                })
                ->rawColumns(['actions', 'created_at', 'permissions_count'])
                ->make(true);
        }

        return view('dashboard.roles.index');
    }

    public function show(): RedirectResponse
    {
        abort_if(!auth()->user()->can('show_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return back();
    }

    public function store(RoleStoreRequest $request): RedirectResponse
    {

        DB::beginTransaction();

        try {
            $role = Role::query()->create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($request->permissions ?? []);

            DB::commit();

            Alert::success('Success', 'Role Created Successfully');

            return redirect()->route('dashboard.roles.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.roles.index');
        }
    }

    public function create()
    {

        abort_if(!auth()->user()->can('create_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::query()->pluck('name', 'id');
        return view('dashboard.roles.create', compact('permissions'));
    }

    public function edit(Role $role)
    {
        abort_if(!auth()->user()->can('edit_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($role->name == 'super-admin' && !auth()->user()->hasRole('super-admin')) {
            Alert::warning('Warning', 'Sorry can`t edit super admin role');
            return redirect()->route('dashboard.roles.index');
        }

        $role->load('permissions');
        $permissions = Permission::query()->pluck('name', 'id');
        return view('dashboard.roles.edit', compact('role', 'permissions'));
    }

    public function update(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $role->update([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($request->permissions ?? []);

            DB::commit();

            Alert::success('Success', 'Role Updated Successfully');

            return redirect()->route('dashboard.roles.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.roles.index');
        }
    }

    public function destroy(Role $role): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($role->name == 'super-admin') {
            Alert::warning('Warning', 'Sorry can`t delete super admin role');
            return redirect()->route('dashboard.roles.index');
        }

        $role->delete();
        Alert::warning('Warning', 'Role Deleted Successfully');
        return redirect()->route('dashboard.roles.index');
    }
}
