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
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = User::with('roles', 'media')->whereHas('roles', function ($query) {
                if (!auth()->user()->hasRole('super-admin')) {
                    $query->where('name', '!=', 'super-admin');
                }
            })->latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_user';
                    $editGate = 'edit_user';
                    $deleteGate = 'delete_user';
                    $crudRoutePart = 'users';
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
                        $links = [];
                        foreach ($row->roles as $role) {
                            $links[] = sprintf("<span class='badge badge-primary'>%s</span>", $role->name);
                        }
                        return implode(' ', $links);
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
        abort_if(!auth()->user()->can('create_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!auth()->user()->hasRole('super-admin')) {
            $roles = Role::query()->where('name', '!=', 'super-admin')->pluck('name', 'id');
        }else{
            $roles = Role::query()->pluck('name', 'id');
        }
        return view('dashboard.user.create', compact('roles'));
    }

    public function show(User $user)
    {
        abort_if(!auth()->user()->can('show_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load('roles', 'media');
        return view('dashboard.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('edit_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load('roles', 'media');
        if (!auth()->user()->hasRole('super-admin')) {
            $roles = Role::query()->where('name', '!=', 'super-admin')->pluck('name', 'id');
        }else{
            $roles = Role::query()->pluck('name', 'id');
        }
        $name = explode(' ', $user->name);
        return view('dashboard.user.edit', compact([
            'user',
            'roles',
            'name',
        ]));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
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
        abort_if(!auth()->user()->can('delete_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
