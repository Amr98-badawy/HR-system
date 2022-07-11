<?php

namespace App\Http\Requests\Sections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSectionRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit_section');
    }

    public function rules(): array
    {
        $data = [
            'department_id' => [
                'required',
                'integer',
                Rule::exists('departments', 'id')
            ]
        ];

        foreach (siteLanguages() as $locale) {
            $data[$locale . '.name'] = [
                'required',
                'string',
                Rule::unique('section_translations', 'name')->ignore($this->section->translate($locale) ? $this->section->translate($locale)->id : $this->section->id),
            ];
        }

        return $data;
    }
}
