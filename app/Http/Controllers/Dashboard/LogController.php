<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_log'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Activity::query()->latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $viewRoute = route('dashboard.logs.show', $row->id);
                    $deleteRoute = route('dashboard.logs.destroy', $row->id);
                    $token = csrf_token();

                    $btns = "
                        <div class='btn-group'>
                        <a class='btn btn-icon btn-primary' href='{$viewRoute}'><i class='fas fa-eye'></i></a>
                        <a class='btn btn-icon btn-danger' href='' onclick='event.preventDefault();document.getElementById(\"delete-form-{$row->id}\").submit()'><i class='fas fa-trash'></i></a>
</div>
                        <form action='{$deleteRoute}' class='hidden' id='delete-form-{$row->id}' method='post'>
                            <input type='hidden' name='_method' value='DELETE'>
                            <input type='hidden' name='_token' value='{$token}'>
                        </form>
                    ";

                    return $btns;
                })
                ->editColumn('record', function ($row) {
                    if ($row->subject_id) {
                        return "Record number {$row->subject_id}";
                    }
                    return '';
                })
                ->editColumn('user', function ($row) {
                    if ($row->causer_id) {
                        return User::query()->find($row->causer_id)->first()->name;
                    }
                    return '';
                })
                ->editColumn('created_at', function ($row) {
                    if ($row->created_at) {
                        return $row->created_at->format('Md Y h:i A');
                    }
                    return '';
                })
                ->editColumn('event', function ($row) {
                    if ($row->event == 'created') {
                        return "<span class='badge badge-success'>{$row->event}</span>";
                    }

                    if ($row->event == 'updated') {
                        return "<span class='badge badge-warning'>{$row->event}</span>";
                    }

                    if ($row->event == 'deleted') {
                        return "<span class='badge badge-danger'>{$row->event}</span>";
                    }
                })
                ->rawColumns(['actions', 'created_at', 'record', 'user', 'event'])
                ->make(true);
        }

        return view('dashboard.log.index');
    }

    public function show(Activity $activity)
    {
        abort_if(!auth()->user()->can('show_log'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('dashboard.log.show', compact('activity'));
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_log'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activity->delete();
        Alert::warning('Warning', 'Record Deleted Successfully');
        return redirect()->route('dashboard.logs.index');
    }
}
