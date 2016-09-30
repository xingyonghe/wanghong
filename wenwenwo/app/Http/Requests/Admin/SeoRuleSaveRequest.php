<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SeoRuleSaveRequest extends FormRequest
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
            'call_key'    => 'required',
            'page_name'   => 'required',
            'title'       => 'required',
            'keywords'    => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'call_key.required'    => '字段必须',
            'page_name.required'   => '字段必须',
            'title.required'       => '字段必须',
            'keywords.required'    => '字段必须',
            'description.required' => '字段必须'
        ];
    }
}
