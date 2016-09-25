<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Response;

class AdminRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'username' => 'required|unique:sys_admin',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages(){
        return [
            'username.required'   => '请填写账号名称',
            'username.unique'     => '账号信息已存在',
            'password.required'   => '请填写账号登陆密码',
            'password.min'        => '账号密码不能低于6位数',
            'password.confirmed'  => '密码确认不一致',
        ];
    }

    protected function formatErrors(Validator $validator){
        $return['error'] = $validator->errors()->first();
        $return['status'] = 0;
        return $return;

    }

    public function response(array $errors){
        return Response::json($errors);
    }
}
