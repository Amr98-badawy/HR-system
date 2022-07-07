<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'first_name' => [
            'required',
            'string',
            'min:1',
            'max:150'
        ],
        'second_name' => [
            'required',
            'string',
            'min:1',
            'max:150'
        ],
        'last_name' => [
            'required',
            'string',
            'min:1',
            'max:150'
        ],
        'email' => [
            'required',
            'email',
            'min:1',
            'max:255',
            Rule::unique('users', 'email')->ignore($this->user)
        ],
        'role_id' => [
            'required',
            'integer',
            Rule::exists('roles', 'id'),
        ]
    ];
    }
}
