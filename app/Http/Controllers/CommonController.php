<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;//基础控制器
use App\Models\Category;//分类模型

class CommonController extends Controller{
    protected $model = '';//模块--分类需要

    /**
     * 模块分类管理
     * @return mixed
     */
    public function category(){
        $model = $this->model;
        $lists = Category::adminLists(array(['model',$model]));
        return view('admin.category.index',compact('lists','model'));
    }
    





























}
