<?php

namespace App\Http\Requests\Languages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('edit_language');
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
                Rule::unique('site_languages', 'name')->ignore($this->language)
            ],
            'lang_locale' => [
                'required',
                'string',
                Rule::unique('site_languages', 'locale')->ignore($this->language)
            ],
        ];
    }
}
