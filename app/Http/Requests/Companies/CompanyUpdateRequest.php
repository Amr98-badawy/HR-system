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
        $data = [
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

        foreach (siteLanguages() as $locale) {
            $data[$locale . '.name'] = [
                'required',
                Rule::unique('company_translations', 'name')->ignore($this->company->translate($locale) ? $this->company->translate($locale)->id : $this->company->id)
            ];
        }

        return $data;
    }

    protected function prepareForValidation()
    {
        if ($this->departments == null) {
            $this->request->remove('departments');
        }
    }
}
