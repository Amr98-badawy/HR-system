<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
                Rule::unique('users', 'email')->ignore($this->user)
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
