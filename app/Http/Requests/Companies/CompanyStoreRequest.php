<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyStoreRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->can('create_company');
    }

    public function rules(): array
    {
        $data = [];


        foreach (siteLanguages() as $locale) {
            $data[$locale . '.name'] = [
                'required',
                Rule::unique('company_translations', 'name')
            ];
        }

        return $data;
    }
}
