<?php

namespace App\Http\Controllers\Admin;

use App\Models\SysAdmin;
use App\Models\SysAuthGroup;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use Request;
use Response;
use Validator;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Support\Facades\Input;
use URL;

class AdminController extends Controller{

    /**
     * 列表
     */
    public function index(){
        $datas = SysAdmin::getLists(10,array(['status','>=','0']));
        $pages = array();
        return view('admin.admin.index',compact('datas','pages'));
    }

    /**
     * 新增管理员
     * @return mixed
     */
    public function add(){
        if(Request::ajax()){
            //用户组
            $groups = SysAuthGroup::where('status','=',1)->get()->toArray();
            $view = view('admin.admin.add',compact('groups'));
            return Response::json(array('html'=>$view->render(),'title'=>'新增管理员账号','status'=>1));
        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 添加管理员
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AdminRequest $request){
        $info = SysAdmin::where(array(['username','=',$request->username],['status','>','-1']))->first();
        if(!empty($info)){
            return Response::json(array('error'=> '管理员账号已存在','status'=>0));
        }
        $res = SysAdmin::updateData($request);
        if($res){
            return Response::json(array('success'=> '管理员信息添加成功','status'=>1,'url'=>URL::previous()));
        }else{
            return Response::json(array('error'=> '管理员信息添加失败','status'=>0));
        }
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){
        if(Request::ajax()){
            $info = SysAdmin::find($id);
            $groups = SysAuthGroup::where('status','=',1)->get()->toArray();//用户组
            $view = view('admin.admin.edit',compact('info','groups'));
            return Response::json(array('html'=>$view->render(),'title'=>'编辑管理员账号','status'=>1));
        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 修改管理员
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editUpdate(HttpRequest $request){
        $info = SysAdmin::findOrFail($request->id);
        $resualt = $info->update(Input::get());
        if($resualt){
            return Response::json(array('success'=> '修改管理员信息新增成功','status'=>1,'url'=>URL::previous()));
        }else{
            return Response::json(array('error'=> '修改管理员信息新增失败','status'=>0));
        }
    }


    /**
     * 删除，状态变为-1
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        $info = SysAdmin::findOrFail($id);
        $resualt = $info->update(array('status'=>-1));
        if($resualt){
            return redirect()->back()->withSuccess('删除管理员信息成功!');
        }else{
            return redirect()->back()->with('error','删除管理员信息失败');
        }
    }

    /**
     * 禁用，状态变为0
     * @param $id
     * @return mixed
     */
    public function forbid($id){
        $info = SysAdmin::findOrFail($id);
        $resualt = $info->update(array('status'=>0));
        if($resualt){
            return redirect()->back()->withSuccess('禁用管理员信息成功!');
        }else{
            return redirect()->back()->with('error','禁用管理员信息失败');
        }
    }

    /**
     * 启用，状态变为1
     * @param $id
     * @return mixed
     */
    public function resume($id){
        $info = SysAdmin::findOrFail($id);
        $resualt = $info->update(array('status'=>1));
        if($resualt){
            return redirect()->back()->withSuccess('启用管理员信息成功!');
        }else{
            return redirect()->back()->with('error','启用管理员信息失败');
        }
    }

    /**
     * 重置密码
     * @return mixed
     */
    public function resetpass(){
        return view('admin.admin.resetpass');
    }

    /**
     * 更新密码
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatepass(HttpRequest $request){
        $rules = [
            'username' => 'required|exists:sys_admin,username',
            'password' => 'required|min:6|confirmed',
        ];
        $messages = [
            'username.required'   => '请填写重置密码的账号',
            'username.exists'     => '账号信息不存在',
            'password.required'   => '请填写新密码',
            'password.min'        => '新密码不能低于6位数',
            'password.confirmed'  => '新密码确认不一致',
        ];
        //成功提示用redirect('admin/admin/resetpass')->withSuccess();视图判断Session::has('success')，视图调用消息Session::get('success')
        //错误提示用redirect()->back()->withInput()->with('error','msg');视图判断Session::has('success')，视图调用消息Session::get('success')
//        return redirect()->back()->withInput()->with('errors','123123213123');die;
//        return Redirect::back()->withErrors(['error'=>'新增失败！','status'=>0]);
//        $this->validate($request, $rules, $messages);这样写用的是默认的错误返回，返回所有的错误提示
        //自己构造Validator::make可以自定义返回信息
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error',$validator->messages()->first());
        }
        $res = SysAdmin::resetPassword($request);
        if($res){
            return redirect()->back()->withSuccess('重置用户密码成功');
        }else{
            return redirect()->back()->withInput()->with('error','重置用户密码失败');
        }
    }
}
