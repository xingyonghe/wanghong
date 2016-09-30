<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
class SenitiveSaveRequest extends FormRequest
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
            'sensitive_name' => 'required',
        ];
    }

    /**
     * 错误信息提示
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sensitive_name.required' => '敏感词内容不可为空',
        ];
    }
}
