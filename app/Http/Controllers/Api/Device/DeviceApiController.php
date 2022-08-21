<?php

namespace App\Http\Controllers\Api\Device;

use App\Http\Controllers\Controller;
use App\Http\Resources\Device\DeviceRecourse;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceApiController extends Controller
{
    public function getDevices()
    {
        $devices = Device::query()->where('status', true)->get();

        return DeviceRecourse::collection($devices)
            ->additional(['message' => 'Router devices retrieved successfully'])
            ->response()
            ->setStatusCode(200);
    }
}
