<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('edit_employee');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => [
                'required',
                'string',
                Rule::unique('employees', 'slug')->ignore($this->employee)
            ],
            'first_name' => [
                'required',
                'string'
            ],
            'second_name' => [
                'required',
                'string'
            ],
            'family_name' => [
                'required',
                'string'
            ],
            'gender' => [
                'required',
                'string',
                Rule::in(['m', 'f'])
            ],
            'status' => [
                'required',
                'string',
                Rule::in(['m', 's', 'w'])
            ],
            'family_count' => [
                Rule::requiredIf($this->status != 's'),
                'integer',
            ],
            'job_title' => [
                'required',
                'string'
            ],
            'date_of_birth' => [
                'required',
                'date',
            ],
            'date_of_employment' => [
                'required',
                'date',
            ],
            'id_card' => [
                'required',
                'string',
            ],
            'address' => [
                'required',
                'string',
            ],
            'mobile' => [
                'required',
                'string',
            ],
            'office_tel' => [
                'nullable',
                'string',
            ],
            'nationality' => [
                'required',
                'string',
            ],
            'company_id' => [
                'required',
                'integer',
                Rule::exists('companies', 'id')
            ],
            'department_id' => [
                'required',
                'integer',
                Rule::exists('departments', 'id')
            ],
            'section_id' => [
                'required',
                'integer',
                Rule::exists('sections', 'id')
            ],
            'shift_id' => [
                'required',
                'integer',
                Rule::exists('shifts', 'id')
            ],
            'salary' => [
                'required',
                'numeric'
            ],
            'bank_account' => [
                'nullable',
                'string'
            ],
            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp'
            ],
            'military_status' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5000'
            ],
            'criminal_record' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5000'
            ],
            'collage_certificate' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5000'
            ],
            'birth_certificate' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5000'
            ],
            'additional_files' => [
                'nullable',
            ],
            'additional_files.*' => [
                'file',
                'mimes:pdf',
                'max:5000'
            ],
        ];
    }
}
