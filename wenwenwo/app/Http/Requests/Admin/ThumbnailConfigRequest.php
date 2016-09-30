<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ThumbnailConfigRequest extends FormRequest
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
            'compress_rate' => 'required|integer|between:1,100',
            'rule'          => 'required',
            'max_size_num'  => 'required|integer|between:1,100',
            'min_width'     => 'required|integer|min:1',
            'min_height'    => 'required|integer|min:1',
            'allow_type'    => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'compress_rate.required' => '必填项',
            'compress_rate.integer'  => '填写1-100之间的数字',
            'compress_rate.between'  => '填写1-100之间的数字',
            'rule.required'          => '必填项',
            'max_size_num.required'  => '请填写整数',
            'max_size_num.integer'   => '请填写整数',
            'max_size_num.between'   => '大小在1-100之间',
            'min_width.required'     => '必须项',
            'min_width.integer'      => '请填写整数',
            'min_width.min'          => '最小值为1',
            'min_height.required'    => '必须项',
            'min_height.integer'     => '请填写整数',
            'min_height.min'         => '最小值为1',
            'allow_type.required'    => '图片扩展名不能为空',
        ];
    }
}
