<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class ProtocolRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'title'   => 'required',
            'content' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required'   => '请填写协议标题',
            'content.required' => '请填写协议内容',
        ];
    }

    protected function formatErrors(Validator $validator){
        return $validator->errors()->getMessages();
    }
}
