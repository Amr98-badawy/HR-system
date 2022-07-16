<?php

namespace App\Http\Resources\Employee;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'account_no' => $this->account_no,
            'name' => $this->fullName,
            'gender' => $this->gender,
            'job_title' => $this->job_title,
            'salary' => $this->salary,
            'company' => $this->whenLoaded('company', function () {
                return $this->company->name;
            }),
            'department' => $this->whenLoaded('department', function () {
                return $this->department->name;
            }),
            'section' => $this->whenLoaded('section', function () {
                return $this->section->name;
            }),
            'shift' => $this->whenLoaded('shift', function () {
                return $this->shift->name;
            }),
            'photo' => $this->whenLoaded('media', function () {
                return $this->getFirstMedia('photo')->getUrl();
            }),
        ];
    }
}
