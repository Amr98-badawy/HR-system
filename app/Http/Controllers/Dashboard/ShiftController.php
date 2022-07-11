<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shifts\StoreShiftRequest;
use App\Http\Requests\Shifts\UpdateShiftRequest;
use App\Models\Shift;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShiftController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_shift'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Shift::query()->latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_shift';
                    $editGate = 'edit_shift';
                    $deleteGate = 'delete_shift';
                    $crudRoutePart = 'shifts';
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
                ->editColumn('from', function ($row) {
                    if ($row->from) {
                        return Carbon::make($row->from)->format('h:i A');
                    }
                    return '';
                })
                ->editColumn('to', function ($row) {
                    if ($row->to) {
                        return Carbon::make($row->to)->format('h:i A');
                    }
                    return '';
                })
                ->editColumn('extra_time', function ($row) {
                    if ($row->extra_time) {
                        return Carbon::make($row->extra_time)->format('h:i A');
                    }
                    return '';
                })
                ->editColumn('active', function ($row) {
                    if ($row->active) {
                        return '<span class="badge badge-success">Active</span>';
                    }
                    return '<span class="badge badge-danger">In Active</span>';
                })
                ->rawColumns(['actions', 'from', 'to', 'extra_time', 'active'])
                ->make(true);
        }

        return view('dashboard.shift.index');
    }

    public function store(StoreShiftRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            Shift::query()->create($request->validated());

            DB::commit();

            Alert::success('Success', 'Shift Created Successfully');

            return redirect()->route('dashboard.shifts.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.shifts.index');
        }
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create_shift'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('dashboard.shift.create');
    }

    public function show(Shift $shift)
    {
        abort_if(!auth()->user()->can('create_shift'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('dashboard.shift.show', compact('shift'));
    }

    public function edit(Shift $shift)
    {
        abort_if(!auth()->user()->can('edit_shift'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('dashboard.shift.edit', compact('shift'));
    }

    public function update(UpdateShiftRequest $request, Shift $shift)
    {
        DB::beginTransaction();

        try {

            $shift->update($request->validated());

            DB::commit();

            Alert::success('Success', 'Shift Updated Successfully');

            return redirect()->route('dashboard.shifts.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.shifts.index');
        }
    }

    public function destroy(Shift $shift)
    {
        abort_if(!auth()->user()->can('access_shift'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shift->delete();

        Alert::warning('Warning', 'Record Deleted Successfully');

        return redirect()->route('dashboard.shifts.index');
    }
}
