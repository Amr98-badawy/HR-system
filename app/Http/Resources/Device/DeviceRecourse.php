<?php

namespace App\Http\Resources\Device;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceRecourse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'mac_address' => $this->mac_address
        ];
    }
}
