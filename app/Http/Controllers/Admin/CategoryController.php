<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;//公用控制器
use Response;//响应
use Illuminate\Http\Request;//请求

use App\Models\Category;

class CategoryController extends CommonController{

    /**
     * 新增分类
     * @return mixed
     */
    public function add(string $model){
        if(request()->ajax() === false){
            return redirect()->back()->with('error','非法请求');
        }
        return response()->json(array('html'=>view('admin.category.edit')->render(),'status'=>1,'title'=>'新增分类','model'=>$model));
    }

//    /**
//     * 编辑
//     * @param $id
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function edit($id){
//        if(empty($id) ||!is_numeric($id)){
//            return redirect()->back()->with('error','参数错误！');
//        }
//        $info = Article::find($id);
//        if(empty($info)){
//            return redirect()->back()->with('error','抱歉,您要查找的数据不存在！');
//        }
//
//        return view('admin.article.edit',compact('info'));
//    }
//
//    /**
//     * 更新
//     * @param AdminRequest $request
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function update(Request $request){
//        $resualt = Article::updateData($request);
//        if($resualt){
//            return redirect('admin/article/index')->withSuccess($resualt->id?'文章信息修改成功!':'文章信息添加成功!');
//        }else{
//            return redirect()->back()->with('error',$resualt->id?'文章信息修改失败!':'文章信息添加失败!');
//        }
//    }
//
//
//    /**
//     * 删除，状态变为-1
//     * @param $id
//     * @return mixed
//     */
//    public function destroy($id){
//        if(empty($id) ||!is_numeric($id)){
//            return redirect()->back()->with('error','参数错误！');
//        }
//        $resualt = Article::where(array(['id',$id]))->update(array('status'=>-1));
//        if($resualt){
//            return redirect()->back()->withSuccess('删除信息成功!');
//        }else{
//            return redirect()->back()->with('error','删除信息失败');
//        }
//    }


}
