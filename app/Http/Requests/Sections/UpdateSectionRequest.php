<?php

namespace App\Http\Requests\Sections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSectionRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit_section');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'departments' => [
                'required',
            ],
            'departments.*' => [
                'integer',
                Rule::exists('departments', 'id')
            ],
        ];
    }
}
