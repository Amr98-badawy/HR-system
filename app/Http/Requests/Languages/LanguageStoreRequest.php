<?php

namespace App\Http\Requests\Languages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create_language');
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
                Rule::unique('site_languages', 'name')
            ],
            'lang_locale' => [
                'required',
                'string',
                Rule::unique('site_languages', 'locale')
            ],
        ];
    }
}
