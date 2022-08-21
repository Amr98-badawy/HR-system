<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit_role');
    }


    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('roles', 'name')->ignore($this->role),
            ],
            'permissions' => [
                'sometimes',
            ],
            'permissions.*' => [
                'integer',
                Rule::exists('permissions', 'id'),
            ]
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->permissions == null) {
            $this->request->remove('permissions');
        }
    }
}
