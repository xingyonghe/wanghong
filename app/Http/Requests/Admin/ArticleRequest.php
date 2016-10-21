<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Response;

class ArticleRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'title' => 'required',
            'content' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required'   => '请填写信息标题',
            'content.required'   => '请填写信息详情内容',
        ];
    }

    protected function formatErrors(Validator $validator){
        $return['error'] = $validator->errors()->first();
        return $return;
    }

    public function response(array $errors){
        return $this->redirector->back()
            ->withInput($this->except($this->dontFlash))
            ->with('error',$errors['error']);
    }



}
