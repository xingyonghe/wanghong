<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class SmsTemplateRequest extends FormRequest
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
            'title' => 'required|unique:sys_sms_templates',
            'content' => 'required',
            'typeid' => 'array|required',
            'client_base' => 'integer|min:0',
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
            'title.required' => '请填写模板名称',
            'title.unique' => '模板标题已存在',
            'content.required' => '请填写模板内容',
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    /*protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }*/
}
