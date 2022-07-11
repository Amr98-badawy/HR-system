<?php

namespace App\Http\Requests\Shifts;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShiftRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit_shift');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('shifts', 'name')->ignore($this->shift)
            ],
            'from' => [
                'required',
                'date_format:H:i',
                'before:to',
            ],
            'extra_time' => [
                'required',
                'date_format:H:i',
                'after:from',
                'before:to',
            ],
            'to' => [
                'required',
                'date_format:H:i',
                'after:from',
            ],
            'active' => [
                'nullable',
                'boolean',
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->request->set('active', (bool)$this->active);
        $this->request->set('from', Carbon::make($this->from)->format('H:i'));
        $this->request->set('to', Carbon::make($this->to)->format('H:i'));
        $this->request->set('extra_time', Carbon::make($this->extra_time)->format('H:i'));
    }
}
