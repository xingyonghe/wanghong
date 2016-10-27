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

    /**
     * ajax字段验证
     * 返回第一条错误信息和错误信息关联字段名称
     * @param $validator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function ajaxValidator($validator){
        //错误字段集合，每个字段对应相应html元素ID
        $errorIds = $validator->messages()->keys();
        return response()->json(array('status'=>0,'info'=>$validator->messages()->first(),'id'=>$errorIds[0]));
    }

    /**
     * ajax返回信息
     * @param $info 提示信息
     * @param $status 状态码 1成功 0失败
     * @param $url 返回地址
     * @return \Illuminate\Http\JsonResponse
     */
    protected function ajaxReturn($info ='', $status=0, $url=''){
        return response()->json(array('status'=>1,'info'=>$info,'url'=>$url));
    }

}
