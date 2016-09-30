<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class SavePasswordRequest extends Request
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
            //
            'old_pass'=>'required|alpha_num|between:6,12',
            'password'=>'required|alpha_num|between:6,12|confirmed',
            'password_confirmation'=>'required|alpha_num|between:6,12'
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'old_pass.required' => '原密码不能为空',
            'old_pass.alpha_num' => '原密码只能是数字和字母',
            'old_pass.between' => '原密码长度必须在6-12位',
            'password.required' => '新密码不能为空',
            'password.alpha_num' => '新密码只能是数字和字母',
            'password.between' => '新密码长度必须在6-12位',
            'password.confirmed' => '新密码必须与确认密码一致',
            'password_confirmation.required' => '确认密码不能为空',
            'password_confirmation.alpha_num' => '确认密码只能是数字和字母',
            'password_confirmation.between' => '确认密码长度必须在6-12位'
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function formatErrors(Validator $validator)
    {
        $return['info'] = $validator->errors()->first();
        $return['status'] = -1;
        return $return;
    }
}
