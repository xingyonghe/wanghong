<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request as HttpRequest;
use Request;
use App\Http\Controllers\Controller;
use App\Models\SysAdmin;
use App\Models\User;
use Response;
use App\Http\Requests\Admin\AdvertiserRequest;
use URL;
use Illuminate\Support\Facades\Input;

class AdvertiserController extends Controller{
    /**
     * 列表
     */
    public function index(){
        $map = array(['type',2]);
        $username = Input::get('username') ?? '';
        if(!empty($username)){
            $map[] = ['username',$username];
        }
        $datas = User::getAdminLists($map,2);
        $pages = array(
            'username' => $username
        );
        return view('admin.user.advertiser_index',compact('datas','pages'));
    }

    /**
     * 新增
     * @return mixed
     */
    public function add(){
        if(Request::ajax()){
            $view = view('admin.user.advertiser_add');
            return Response::json(array('html'=>$view->render(),'title'=>'新增广告主','status'=>1));
        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){
        if(empty($id) ||!is_numeric($id)){
            return redirect()->back()->with('error','参数错误！');
        }
        $info = User::where(array(['type',2]))->whereIn('status',['0','1'])->leftJoin('user_ads', 'user.id', '=', 'user_ads.user_id')->find($id);
        if(empty($info)){
            return redirect()->back()->with('error','抱歉,您要查找的数据不存在！');
        }
        return view('admin.user.advertiser_edit',compact('info'));
    }

    /**
     * 更新
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AdvertiserRequest $request){
        $info = User::where(array(['username','=',$request->username],['status','>','-1']))->first();
        if($info){
            return Response::json(array('error'=> '该手机号已经注册','status'=>0));
        }
        $res = User::updateData($request);
        if($res){
            return Response::json(array('success'=> '广告主信息添加成功','status'=>1,'url'=>URL::previous()));
        }else{
            return Response::json(array('error'=> '广告主信息添加失败','status'=>0));
        }
    }

    /**
     * 更新
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(HttpRequest $request){
        $resualt = User::updateData($request);
        if($resualt){
            return redirect('admin/advertiser/index')->withSuccess('广告主信息修改成功!');
        }else{
            return redirect()->back()->with('error','广告主信息修改失败');
        }
    }


    /**
     * 删除，状态变为-1
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        if(empty($id) ||!is_numeric($id)){
            return redirect()->back()->with('error','参数错误！');
        }
        $resualt = User::where(array(['id',$id]))->update(array('status'=>-1));
        if($resualt){
            return redirect()->back()->withSuccess('删除用户信息成功!');
        }else{
            return redirect()->back()->with('error','删除用户信息失败');
        }
    }

    /**
     * 禁用，状态变为0
     * @param $id
     * @return mixed
     */
    public function forbid($id){
        if(empty($id) ||!is_numeric($id)){
            return redirect()->back()->with('error','参数错误！');
        }
        $resualt = User::where(array(['id',$id]))->update(array('status'=>0));
        if($resualt){
            return redirect()->back()->withSuccess('禁用用户信息成功!');
        }else{
            return redirect()->back()->with('error','禁用用户信息失败');
        }
    }

    /**
     * 启用，状态变为1
     * @param $id
     * @return mixed
     */
    public function resume($id){
        if(empty($id) ||!is_numeric($id)){
            return redirect()->back()->with('error','参数错误！');
        }
        $resualt = User::where(array(['id',$id]))->update(array('status'=>1));
        if($resualt){
            return redirect()->back()->withSuccess('启用用户信息成功!');
        }else{
            return redirect()->back()->with('error','启用用户信息失败');
        }
    }

    /**
     * 为用户添加客服
     * @param $id 用户ID
     */
    public function addCustom($id){
        if(Request::ajax()){
            $customs = SysAdmin::getCustom();
            $view = view('admin.user.add_custom',compact('customs','id'));
            return Response::json(array('html'=>$view->render(),'title'=>'添加客服','status'=>1));
        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 更新客服
     * @param $id 用户ID
     */
    public function postCustom(HttpRequest $request){
        $info = SysAdmin::find($request->custom_id);
        $resualt = User::where(array(['id',$request->id]))->update(array('custom_id'=>$info->id,'custom_name'=>$info->nickname));
        if($resualt){
            return Response::json(array('success'=> '添加客服成功','status'=>1,'url'=>URL::previous()));
        }else{
            return Response::json(array('error'=> '添加客服失败','status'=>0));
        }
    }
}
