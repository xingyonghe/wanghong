<?php

namespace App\Http\Controllers\Admin;

use App\Models\SysAdmin;
use App\Models\SysAuthGroup;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use View;
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
        $datas = SysAdmin::getLists();
        $pages = array();
        return view('admin.admin.index',compact('datas','pages'));
    }

    /**
     * 添加管理员
     * @return mixed
     */
    public function add(){
        if(Request::ajax()){
            //用户组
            $groups = SysAuthGroup::where('status','=',1)->get()->toArray();
            $view = View::make('admin.admin.add',compact('groups'));
            return Response::json(array('html'=>$view->render(),'title'=>'添加管理员账号'));
        }else{
            return Redirect::back()->withErrors(['error'=>'请求超时','status'=>0]);
        }
    }

    public function edit($id){
//        if(Request::ajax()){
//            $info = SysAuthGroup::find($id);
//            $view = View::make('admin.auth.group_edit',compact('info'));
//            return Response::json(array('html'=>$view->render(),'title'=>'修改管理员账号'));
//
//        }else{
//            return Redirect::back()->withErrors(['error'=>'请求超时','status'=>0]);
//        }
    }

    public function update(AdminRequest $request){
        $res = SysAdmin::updateData($request);
        if($res){
            return Response::json(array('success'=> '管理员信息新增成功','status'=>1,'url'=>URL::previous()));
        }else{
            return Response::json(array('error'=> '管理员信息新增失败','status'=>0));
        }
    }

    public function destroy($id){

    }


    public function resetpass(){
        return view('admin.admin.resetpass');
    }

    public function updatepass(Request $request){
        $rules = [
            'username' => 'required',
            'password' => 'required|min:6|confirmed',
        ];
        $messages = [
            'username.required'   => '请填写重置密码的账号',
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

        $validator->after(function($validator) {
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error',$validator->messages()->first());
        }
        dd(213123);
        $info = SysAdmin::where(array(['username','=',$request->username]))->first();
        if(empty($info)){
            return redirect()->back()->withInput([$request->username,'username'])->withErrors(['error'=>'用户账号信息不存在','status'=>0]);
        }

    }
}
