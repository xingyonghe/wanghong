<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class ReminderPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $id = $this->route('reminder');
        return [
            'title'   => 'required',
            'name'    => 'required|lowercase|unique:sys_reminder,name,'.$id,
            'content' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required'   => '请填写提示语名称',
            'name.required'    => '请填写提示语标识',
            'name.lowercase'   => '提示语标识只能有小写字母组成',
            'name.unique'      => '提示语标识已经存在',
            'content.required' => '提示语内容不能为空',
        ];
    }

    protected function formatErrors(Validator $validator){
        return $validator->errors()->getMessages();
    }
}
