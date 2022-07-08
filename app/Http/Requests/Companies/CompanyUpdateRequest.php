<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit_company');
    }

    public function rules(): array
    {
        $data = [];

        foreach (siteLanguages() as $locale) {
            $data[$locale . '.name'] = [
                'required',
                Rule::unique('company_translations', 'name')->ignore($this->company->transalte($locale) ? $this->company->transalte($locale)->id : $this->company->id)
            ];
        }

        return $data;
    }
}
