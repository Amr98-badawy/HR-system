<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyStoreRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->can('create_company');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('companies', 'name')
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
