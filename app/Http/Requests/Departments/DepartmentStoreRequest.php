<?php

namespace App\Http\Requests\Departments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create_department');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
            ],
            'companies' => [
                'sometimes'
            ],
            'companies.*' => [
                'integer',
                Rule::exists('companies', 'id')
            ]
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->companies == null) {
            $this->request->remove('companies');
        }
    }
}
