<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with('roles', 'media')->latest()->get();

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
                ->editColumn('picture', function ($row) {
                    if ($row->getFirstMedia('picture')) {
                        return sprintf(
                            '<a href="%s" target="_blank"><img class="rounded-50" src="%s" width="50px" height="50px"></a>',
                            $row->getFirstMedia('picture')->getUrl(),
                            $row->getFirstMedia('picture')->getUrl('thumb'),
                        );
                    }
                    return sprintf(
                        '<a href="%s" target="_blank"><img class="rounded-50" src="%s" width="50px" height="50px"></a>',
                        asset('assets/img/Avatar/user-avatar.png'),
                        asset('assets/img/Avatar/user-avatar.png'),
                    );
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
                ->rawColumns(['actions', 'roles', 'created_at', 'picture'])
                ->make(true);
        }

        return view('dashboard.user.index');
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $user = User::query()->create([
                'name' => $request->first_name . ' ' . $request->second_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->hasFile('picture')) {
                $user->addMedia($request->file('picture'))->toMediaCollection('picture');
            }

            $user->syncRoles($request->roles);

            DB::commit();

            Alert::success('success', 'Record created successfully');

            return redirect()->route('dashboard.users.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong please try again');
            return redirect()->route('dashboard.users.index');
        }
    }

    public function create()
    {
        $roles = Role::query()->pluck('name', 'id');

        return view('dashboard.user.create', compact('roles'));
    }

    public function show(User $user)
    {
        $user->load('roles', 'media');
        return view('dashboard.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load('roles', 'media');
        $roles = Role::query()->pluck('name', 'id');
        $name = explode(' ', $user->name);
        return view('dashboard.user.edit', compact([
            'user',
            'roles',
            'name',
        ]));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->first_name . ' ' . $request->second_name . ' ' . $request->last_name,
                'email' => $request->email,
            ]);

            if ($request->hasFile('picture')) {
                $user->addMedia($request->file('picture'))->toMediaCollection('picture');
            }

            $user->syncRoles($request->roles);

            DB::commit();

            Alert::success('success', 'Record Updated successfully');

            return redirect()->route('dashboard.users.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong please try again');
            return redirect()->route('dashboard.users.index');
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->hasRole('super-admin')) {
            Alert::error('Error', 'Can`t delete super admin account');
            return redirect()->route('dashboard.users.index');
        }

        if (auth()->user()->email === $user->email) {
            Alert::error('Error', 'Please logout first then delete account');
            return redirect()->route('dashboard.users.index');
        }

        $user->delete();

        Alert::warning('Warning', 'Record Deleted Successfully');

        return redirect()->route('dashboard.users.index');
    }
}
