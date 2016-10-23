<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;//公用控制器

class CategoryController extends CommonController{

    /**
     * 新增分类
     * @return mixed
     */
    public function add(string $model){
        if(request()->ajax() === false){
            return redirect()->back()->with('error','非法请求');
        }
        $menus = D('Category')->getMenu($model);
        return response()->json(array(
                'html'   =>view('admin.category.edit',compact('model','menus'))->render(),
                'status' =>1,
                'title'  =>'新增分类',
            ));
    }

    /**
     * 编辑分类
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){
        if(request()->ajax() === false){
            return redirect()->back()->with('error','非法请求');
        }
        if(empty($id) ||!is_numeric($id)){
            return response()->json(array('error'=>'参数错误', 'status'=>0));
        }
        $info = D('Category')->find($id);
        if(empty($info)){
            return response()->json(array('error'=>'抱歉,您要查找的数据不存在！', 'status'=>0));
        }
        $menus = D('Category')->getMenu($info['model']);
        return response()->json(array(
            'html'   =>view('admin.category.edit',compact('info','menus'))->render(),
            'status' =>1,
            'title'  =>'编辑分类',
        ));
    }


    /**
     * 新增/更新分类
     */
    public function update(){
        if(empty(request()->name)){
            return response()->json(array('error'=>'请填写分类名称', 'status'=>0));
        }
        $resualt = D('Category')->updateData(request()->all());
        if($resualt){
            cache()->forget('CATEGORY_LIST');
            return response()->json(array('success' => $resualt['id']?'修改分类成功!':'新增分类成功!',
                'status'=>1, 'url'=> url()->previous()));
        }else{
            return response()->json(array('error'=>D('Category')->getError(), 'status'=>0));
        }
    }

    /**
     * 根据ID彻底删除
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        if(empty($id) ||!is_numeric($id)){
            return redirect()->back()->with('error','参数错误！');
        }
        $resualt = D('Category')->destroy($id);
        if($resualt){
            cache()->forget('CATEGORY_LIST');
            return redirect()->back()->withSuccess('删除成功!');
        }else{
            return redirect()->back()->with('error','删除失败');
        }
    }





}
