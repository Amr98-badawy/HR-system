<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create_employee');
    }

    public function rules(): array
    {
        return [
            'slug' => [
                'required',
                'string',
                Rule::unique('employees', 'slug')
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
                'required',
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
                'required',
            ],
            'photo' => [
                'required',
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

    protected function prepareForValidation()
    {
        $this->request->add([
            'slug' => Str::slug("{$this->first_name} {$this->second_name} {$this->family_name}")
        ]);
    }
}
