<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class SmsTestRequest extends FormRequest
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
            'template_id' => 'required|integer|min:1',
            'content' => 'required',
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
            'template_id.required' => '请选择短信模板',
            'template_id.integer' => '请求参数异常',
            'content.required' => '请录入需要发送的短信手机号',
        ];
    }
}
