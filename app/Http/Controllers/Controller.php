<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Contracts\Validation\Validator;

class Controller extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 自定义保存在session中的验证错误信息的格式
     */
    protected function formatValidationErrors(Validator $validator){
        $errors['error']  = $validator->errors()->all();
        $errors['status'] = 0;
        return $errors;
    }
}
