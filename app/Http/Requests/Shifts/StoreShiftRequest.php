<?php

namespace App\Http\Requests\Shifts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreShiftRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->can('create_shift');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('shifts', 'name')
            ],
            'from' => [
                'required',
                'date_format:H:i',
//                'before:to'
            ],
            'extra_time' => [
                'required',
                'date_format:H:i',
//                'after:from',
//                'before:to'
            ],
            'to' => [
                'required',
                'date_format:H:i',
//                'after:from',
            ],
            'active' => [
                'nullable',
                'boolean'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->request->set('active', (bool)$this->active);
    }

}
