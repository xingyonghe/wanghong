<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class ParamsPost extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        $id = $this->route('parameter');
        return [
            'type'    => 'required',
            'cate'    => 'required',
            'shape'   => 'positive',
            'title'   => 'required',
            'name'    => 'required|lowercase|unique:sys_param,name,'.$id,
            'content' => 'required',
            'note'    => 'required',
            'alt'     => 'required',
        ];
    }

    public function messages(){
        return [
            'type.required'    => '请选择参数类型',
            'cate.required'    => '请选择参数类目',
            'shape.positive'   => '请选择控件类型',
            'title.required'   => '请填写参数名称',
            'name.required'    => '请填写参数标识',
            'name.lowercase'   => '参数标识只能有小写字母组成',
            'name.unique'      => '参数标识已经存在',
            'content.required' => '请填写参数值',
            'note.required'    => '请填写参数备注',
            'alt.required'     => '请填写参数Title',
        ];
    }

    protected function formatErrors(Validator $validator){
        return $validator->errors()->getMessages();
    }
}
