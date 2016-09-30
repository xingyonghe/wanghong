<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCategorySaveRequest extends FormRequest
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
            'id'            => 'integer|min:0',
            'parent_id'     => 'integer|min:0',
            'category_name' => 'required',
            'short_name'    => 'required'
        ];
    }
    public function messages()
    {
        return [
            'id.integer' => '参数不对',
            'parent_id.integer' => '分类不对',
            'category_name.required' => '必须填写',
            'short_name.required' => '必须填写',
        ];
    }
}
