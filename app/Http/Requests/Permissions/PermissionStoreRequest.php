<?php

namespace App\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionStoreRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->can('create_permission');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('permissions', 'name'),
            ]
        ];
    }
}
