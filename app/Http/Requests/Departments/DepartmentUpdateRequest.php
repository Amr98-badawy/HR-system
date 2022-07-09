<?php

namespace App\Http\Requests\Departments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('edit_department');
    }

    public function rules(): array
    {
        $data = [
            'companies' => [
                'sometimes'
            ],
            'companies.*' => [
                'integer',
                Rule::exists('companies', 'id')
            ]
        ];

        foreach (siteLanguages() as $locale) {
            $data[$locale . '.name'] = [
                'required',
                Rule::unique('department_translations', 'name')->ignore($this->department->translate($locale) ? $this->department->translate($locale)->id : $this->department->id)
            ];
        }

        return $data;
    }

    protected function prepareForValidation()
    {
        if ($this->companies == null) {
            $this->request->remove('companies');
        }
    }
}
