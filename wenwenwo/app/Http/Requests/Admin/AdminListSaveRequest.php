<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;
class AdminListSaveRequest extends Request
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
            'name' => 'required|max:30',
            'user_name' => 'required|max:30',
            'user_pin' => 'sometimes|max:30',
            'phone' => 'required|max:11',
            'role_id' => 'required|max:2',
            'position_id' => 'required|max:2',
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
            'name.required' => '登录账号不能为空',
            'name.max' => '账号长度不能超过30位',
            'user_name.required' => '真实姓名不能为空',
            'user_name.max' => '真实姓名长度不能大于30位',
            'user_pin.max' => '姓名全拼长度不能大于30位',
            'phone.required' => '电话号码必须',
            'phone.max' => '电话号码长度不能大于11位',
            'role_id.required' => '请选择权限组',
            'position_id.required' => '请选择所属职位',
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        $return['info'] = $validator->errors()->first();
        $return['status'] = -1;
        return $return;
    }
}
