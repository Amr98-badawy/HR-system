<?php

namespace App\Http\Requests\Devices;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeviceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('edit_device');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('devices', 'name')->ignore($this->device)
            ],
            'mac_address' => [
                'required',
                'string',
                Rule::unique('devices', 'mac_address')->ignore($this->device)
            ],
            'status' => [
                'nullable'
            ]
        ];
    }
}
