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
                Rule::unique('devices', 'mac_address')
            ],
            'status' => [
                'nullable'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->request->set('status', (bool)$this->status);
    }
}
