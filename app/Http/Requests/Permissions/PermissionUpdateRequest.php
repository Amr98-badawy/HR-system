<?php

namespace App\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit_permission');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('permissions', 'name')->ignore($this->permission),
            ]
        ];
    }
}
