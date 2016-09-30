<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\SysPosition;

class PositionController extends Controller
{
    //
    public function position_list(){
        $list = SysPosition::paginate(1);
//        $list = SysPosition::get()->toArray();
//        print_r($list);die;
        return view('admin.position.position_list',compact('list'));
    }

    //修改权限信息
    public function positionEdit($id){
        //获取当前权限组的权限节点
        $info = SysPosition::where(['id'=>$id])->first()->toArray();
//        print_r($info);die;
        return view('admin.position.positionEdit',compact('info'));
    }

    //新增权限组
    public function positionAdd(){
        return view('admin.position.positionAdd');
    }

    public function savePosition(Request $request){
        $post = $request->except('_token');
        if(isset($post['id'])){
            $id = (int) $post['id'];
        }
        $post['sort'] = empty($post['sort'])?0:$post['sort'];
        $name = $post['name'];
        if(empty($name)){
            return AjaxReturns('职位名称必须');
        }
        if(isset($id) && $id > 0){
            //修改权限组
            $result = SysPosition::where(['id'=>$id])->update($post);
            if($result){
                return AjaxReturns('修改成功',1);
            }
            return AjaxReturns('修改失败');
        }else{
            //新增权限组
            $result = SysPosition::create($post);
            if($result){
                return AjaxReturns('添加成功',1);
            }
            return AjaxReturns('添加失败');
        }
    }
}
