<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AuthGroupRequest;
use App\Models\SysAuthGroup;
use App\Models\SysMenu;
use App\Models\SysAuthRule;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use View;
use Request;
use Response;
use URL;

class AuthController extends Controller{

    /**
     * 权限分组列表
     */
    public function group(){
        $datas = SysAuthGroup::getLists(20);
        return view('admin.auth.group',compact('datas'));
    }

    /**
     * 添加用户组
     */
    public function addGroup(){
        if(Request::ajax()){
            $view = View::make('admin.auth.group_add');
            return Response::json(array('html'=>$view->render(),'title'=>'添加用户组','status'=>1));
        }else{
            return redirect()->back()->withErrors('error','请求超时');
        }
    }

    /**
     * 菜单用户组
     */
    public function editGroup($id){
        if(Request::ajax()){
            $info = SysAuthGroup::find($id);
            $view = View::make('admin.auth.group_edit',compact('info'));
            return Response::json(array('html'=>$view->render(),'title'=>'修改用户组','status'=>1));

        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 用户组更新
     * URL::previous() 获取上一次请求地址
     */
    public function updateGroup(AuthGroupRequest $request){
        $res = SysAuthGroup::updateData($request);
        if($res){
            return Response::json(array('success'=> $res['id']?'用户组修改成功':'用户组新增成功','status'=>1,'url'=>URL::previous()));
        }else{
            return Response::json(array('error'=> $res['id']?'用户组更新失败':'用户组新增失败','status'=>0));
        }
    }

    /**
     * 删除用户组
     */
    public function destroyGroup($id){
        $datas = SysAuthGroup::find($id);
        if($datas->delete()){
            return redirect()->back()->withSuccess('删除用户组成功!');
        }else{
            return redirect()->back()->withErrors('error','删除用户组失败');
        }
    }


    /**
     * 用户组授权
     */
    public function access($id){
        //自动更新节点
        SysAuthRule::updateRules();
        $nodeList   = SysMenu::returnNodes();
        //url节点
        $childRules = SysAuthRule::getRules(array(array('type','=',1)));
        //主菜单节点
        $mainRules = SysAuthRule::getRules(array(array('type','=',2)));
        //已设置的组权限
        $data = SysAuthGroup::select('rules')->findOrFail($id)->toArray();
        $thisRules = json_encode($data['rules']);

        $groupId = $id;
        return view('admin.auth.access',compact('nodeList','mainRules','childRules','groupId','thisRules'));
    }

    /**
     * 更新权限组
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function writeGroup(Request $request){
        $rules = Input::get('rules');
        $id = Input::get('id');
        $data = SysAuthGroup::findOrFail($id);
        $res = $data->update(array('rules'=>$rules,'id'=>$id));
        if($res){
            return redirect('admin/auth/group')->withSuccess('更新用户组权限成功!');
        }else{
            return redirect()->back()->with('error','更新用户组权限失败');
        }
    }




}
