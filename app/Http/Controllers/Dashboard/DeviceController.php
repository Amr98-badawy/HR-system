<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Devices\DeviceStoreRequest;
use App\Http\Requests\Devices\DeviceUpdateRequest;
use App\Models\Device;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('access_device'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Device::latest()->get();

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    $showGate = 'show_device';
                    $editGate = 'edit_device';
                    $deleteGate = 'delete_device';
                    $crudRoutePart = 'devices';
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
                ->editColumn('status', function ($row) {
                    if ($row->status) {
                        return '<span class="pulse-success" style="position: relative"></span>';
                    } else {
                        return '<span class="pulse-danger" style="position: relative"></span>';
                    }
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        return view('dashboard.device.index');
    }

    public function store(DeviceStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            Device::query()->create([
                'name' => $request->name,
                'mac_address' => $request->mac_address,
                'status' => (bool)$request->status,
            ]);

            DB::commit();
            Alert::success('Success', 'Record Created Successfully');
            return redirect()->route('dashboard.devices.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.devices.index');
        }
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create_device'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.device.create');
    }

    public function show(Device $device)
    {
        abort_if(!auth()->user()->can('show_device'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.device.create', compact('device'));
    }


    public function edit(Device $device)
    {
        abort_if(!auth()->user()->can('edit_device'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.device.create', compact('device'));
    }

    public function update(DeviceUpdateRequest $request, Device $device): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $device->update([
                'name' => $request->name,
                'mac_address' => $request->mac_address,
                'status' => (bool)$request->status,
            ]);

            DB::commit();
            Alert::success('Success', 'Record updated Successfully');
            return redirect()->route('dashboard.devices.index');

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong, please try again');
            return redirect()->route('dashboard.devices.index');
        }
    }

    public function destroy(Device $device)
    {
        $device->delete();
        Alert::warning('Warning', 'Record Deleted Successfully');

        return redirect()->route('dashboard.devices.index');
    }
}
