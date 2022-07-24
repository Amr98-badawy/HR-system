<?php

namespace App\Http\Resources\Attendance;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class AttendanceCheckInResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
        ];
    }
}
