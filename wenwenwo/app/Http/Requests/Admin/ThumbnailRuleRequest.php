<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ThumbnailRuleRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required',
            'width'  => 'required|integer|min:1',
            'height' => 'required|integer|min:1',
            'types'  => 'array'
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => '必填项',
            'width.required'  => '必填项',
            'width.integer'   => '只能填写大于1的数字',
            'width.min'       => '只能填写大于1的数字',
            'height.required' => '必填项',
            'height.integer'  => '只能填写大于1的数字',
            'height.min'      => '只能填写大于1的数字',
        ];
    }
}
