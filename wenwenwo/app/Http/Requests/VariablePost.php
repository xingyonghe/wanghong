<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class VariablePost extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    public function rules(){
        $id = $this->route('variable');
        return [
            'name' => 'required',
            'variable' => 'required|lowercase|unique:sys_variable,variable,'.$id,
            'confines' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => '变量名称不能为空',
            'variable.required' => '变量标识不能为空',
            'variable.lowercase' => '变量标识只能由小写字母组成',
            'variable.unique' => '变量标识已经存在',
            'confines.required' => '应用范围不能为空',
        ];
    }

    protected function formatErrors(Validator $validator){
        return $validator->errors()->getMessages();
    }
}
