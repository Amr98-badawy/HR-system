<?php

namespace App\Http\Requests\Devices;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeviceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create_device');
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
                Rule::unique('devices', 'name')
            ],
            'mac_address' => [
                'required',
                'string',
                'regex:/^([0-9A-a]{2}[:-]){5}([0-9A-a]{2})$/',
                Rule::unique('devices', 'mac_address')
            ],
            'status' => [
                'sometimes'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->status == null) {
            $this->request->remove('status');
        }
    }
}
