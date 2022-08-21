<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit_company');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('companies', 'name')->ignore($this->company)
            ],
            'logo' => [
                'nullable',
                'image',
                'mimes:png,svg,webp,jpg,jpeg'
            ],
            'departments' => [
                'sometimes'
            ],
            'departments.*' => [
                'integer',
                Rule::exists('departments', 'id')
            ]
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->departments == null) {
            $this->request->remove('departments');
        }
    }
}
