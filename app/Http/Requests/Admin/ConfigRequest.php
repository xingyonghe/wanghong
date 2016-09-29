<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Response;

class ConfigRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        $id = $this->get('id');
        return [
            'title' => 'required',
            'name' => 'required|unique:sys_config,name,'.$id,
        ];
    }

    public function messages(){
        return [
            'title.required' => '请填写配置标题',
            'name.required'   => '请填写配置标识',
            'name.unique'   => '配置标识已经存在',
        ];
    }

    protected function formatErrors(Validator $validator){
        $return['error'] = $validator->errors()->first();
        $return['status'] = 0;
        return $return;
    }

    public function response(array $errors){
        return redirect()->back()->withInput()->with('error',$errors['error']);
    }
}
