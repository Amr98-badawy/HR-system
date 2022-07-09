<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\RoleStoreRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->can('access_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        $permissions = Permission::query()->pluck('name','id');
        return view('dashboard.roles.create', compact('permissions'));
    }

    public function edit(Role $role)
    {
        abort_if(!auth()->user()->can('edit_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role->load('permissions');
        $permissions = Permission::query()->pluck('name','id');
        return view('dashboard.roles.edit', compact('role' ,'permissions'));
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
        $role->delete();
        Alert::warning('Warning', 'Role Deleted Successfully');
        return redirect()->route('dashboard.roles.index');
    }
}
