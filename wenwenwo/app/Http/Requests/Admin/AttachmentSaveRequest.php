<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class AttachmentSaveRequest extends FormRequest
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
            'max_one_size' => 'required|integer',
            'max_total_size' => 'required|integer',
            'max_total_num' => 'required|integer',
            'allow_type' => 'required|min:1',
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
            'max_one_size.required' => '单个附件最大尺寸不能为空',
            'max_one_size.integer' => '请填写整数',
            'max_total_size.required' => '每天最大附件总尺寸不能为空',
            'max_total_size.integer' => '请填写整数',
            'max_total_num.required' => '每天最大附件数量不能为空',
            'max_total_num.integer' => '请填写整数',
            'allow_type.required' => '允许的附件类型不能为空',
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
