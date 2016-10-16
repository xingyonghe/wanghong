<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Response;

class AdvertiserRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        $id = $this->get('id');
        return [
            'username' => 'required|mobile',
            'nickname' => 'required',
            'password' => 'required|min:6',
        ];
    }

    public function messages(){
        return [
            'username.required'   => '请填写广告主的手机号码',
            'username.mobile'     => '手机号码格式错误',
            'nickname.required'   => '请填写联系人名称',
            'password.required'   => '请填写账号登陆密码',
            'password.min'        => '账号密码不能低于6位数',
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
