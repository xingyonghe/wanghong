<?php

namespace App\Http\Controllers;

class CommonController extends Controller{

    /**
     * 模块分类管理
     * @return mixed
     */
    public function category(){
        $model = $this->model;
        $lists = D('Category')->getCategory(array(['model',$model]));
        if($lists){
            $lists = list_to_tree($lists);
        }
        return view('admin.category.index',compact('lists','model'));
    }


    





























}
