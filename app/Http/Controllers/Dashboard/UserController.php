<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with('roles')->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $view = route('dashboard.users.show', $row->id);
                    $edit = route('dashboard.users.edit', $row->id);
                    $delete = route('dashboard.users.destroy', $row->id);

                    $btn = sprintf(
                        '<div class="row row-xs wd-xl-80p">
                                    <div class="col-sm-6 col-md-3">
                                        <button data-toggle="dropdown" class="btn btn-indigo btn-block">Actions <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i></button>
                                        <div class="dropdown-menu">
                                            <a href="%s" class="dropdown-item text-primary"><i class="fas fa-eye"></i> View</a>
                                            <a href="%s" class="dropdown-item text-warning"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="" onclick="event.preventDefault();document.getElementById(\'deleteForm-%s\'    ).submit()" class="dropdown-item text-danger"><i class="fas fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
		                        </div>
		                        <form action="%s" method="post" id="deleteForm-%s" class="d-none">
                                    <input type="hidden" name="_method" value="DELETE">
		                            %s
                                </form>',
                        $view,
                        $edit,
                        $row->id,
                        $delete,
                        $row->id,
                        csrf_field(),
                    );

                    return $btn;
                })
                ->editColumn('roles', function ($row) {
                    if ($row->roles) {
                        foreach ($row->roles as $role) {
                            return sprintf("<span class='badge badge-primary'>%s</span>", $role->name);
                        }
                    }
                    return '';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('Md Y') : '';
                })
                ->rawColumns(['actions', 'roles', 'created_at'])
                ->make(true);
        }

        return view('dashboard.user.index');
    }

    public function create()
    {
        $roles = Role::query()->pluck('name', 'id');

        return view('dashboard.user.create', compact('roles'));
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = User::query()->create([
            'name' => $request->first_name . ' ' . $request->second_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        Alert::success('success', 'Record created successfully');

        return redirect()->route('dashboard.users.index');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::query()->pluck('name', 'id');

        return view('dashboard.user.edit', compact([
            'user',
            'roles'
        ]));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        //
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        Alert::warning('Warning', 'Record Deleted Successfully');

        return redirect()->route('dashboard.users.index');
    }
}
