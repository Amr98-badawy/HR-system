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
        return auth()->user()->can('create_user');
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
            'roles' => [
                'required',
            ],
            'roles.*' => [
                'integer',
                Rule::exists('roles', 'id'),
            ],
            'picture' => [
                'nullable',
                'image',
                'max:2500',
                'mimes:jpg,jpeg,png,webp,svg'
            ]
        ];
    }
}
