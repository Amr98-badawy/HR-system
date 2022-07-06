<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
//        abort_if(!auth()->user()->can('access_user'), Response::HTTP_FORBIDDEN, '403 forbidden');
//
//        if ($request->ajax()) {
//            $query = User::with('roles')->get();
//            $table = DataTables::of($query);
//
//            $table->addColumn('placeholder', '&nbsp;');
//            $table->addColumn('actions', '&nbsp;');
//
//            $table->editColumn('actions', function ($row) {
//                $viewGate = 'user_show';
//                $editGate = 'user_edit';
//                $deleteGate = 'user_delete';
//                $crudRoutePart = 'users';
//
//                return view('partials.datatablesActions', compact(
//                    'viewGate',
//                    'editGate',
//                    'deleteGate',
//                    'crudRoutePart',
//                    'row'
//                ));
//            });
//
//            $table->editColumn('id', function ($row) {
//                return $row->id ? $row->id : '';
//            });
//
//            $table->editColumn('name', function ($row) {
//                return $row->name ? $row->name : '';
//            });
//
//            $table->editColumn('email', function ($row) {
//                return $row->email ? $row->email : '';
//            });
//
//            $table->editColumn('roles', function ($row) {
//                $labels = [];
//
//                foreach ($row->roles as $role) {
//                    $labels[] = sprintf(
//                        '<span class="badge badge-primary">%s</span>',
//                        $role->name
//                    );
//                }
//
//                 return implode(' ', $labels);
//            });
//
//            $table->rawColumns(['actions', 'placeholder']);
//
//            return $table->make(true);
//        }
//
//        return view();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
