<?php

namespace App\Http\Requests\Export;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceExportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => [
                'nullable',
                'integer'
            ],
            'start_date' => [
                'nullable',
                'date'
            ],
            'end_date' => [
                'required_if:start_date,!=,null',
                'date'
            ],
        ];
    }
}
