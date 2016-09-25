<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Response;

class MenuRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'title' => 'required',
            'url'   => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required' => '请填写菜单标题',
            'url.required'   => '请填写菜单url地址',
        ];
    }

    protected function formatErrors(Validator $validator){
        $return['error'] = $validator->errors()->first();
        $return['status'] = 0;
        return $return;
//        return $validator->errors()->getMessages();

    }

    public function response(array $errors){
        return Response::json($errors);
    }
}
