<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;


class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('super-admin');
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
                Rule::unique('users', 'email')
            ],
            'password' => [
                'required',
                'confirmed',
                'max:25',
                Password::min(8)->letters()->mixedCase()
            ],
            'role_id' => [
                'required',
                'integer',
                Rule::exists('roles', 'id'),
            ]
        ];
    }
}
