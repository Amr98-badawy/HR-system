<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'account_no' => $this->account_no,
            'name' => $this->fullName,
            'email' => $this->email,
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
            'from' => $this->whenLoaded('shift', function () {
                return $this->shift->from;
            }),
            'to' => $this->whenLoaded('shift', function () {
                return $this->shift->to;
            }),
            'photo' => $this->whenLoaded('media', function () {
                return $this->getFirstMedia('photo')->getUrl();
            }),
        ];
    }
}
