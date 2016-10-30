<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\CommonController;

class IndexController extends CommonController{

    public function __construct(){
        view()->share('nav',1);//设置导航高亮
    }

    /**
     * 基本资料页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = D('User')->with('personal')->find(auth()->id());
        return view('user.index.index',compact('user'));
    }

    /**
     * 修改基本资料
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(){
        $user = D('User')->with('personal')->find(auth()->id());
        return view('user.index.edit',compact('user'));
    }

    /**
     * 更新基本资料
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(){
        $rules = [
            'nickname' => 'required',
            'qq'  => 'required',
        ];
        $msgs = [
            'nickname.required' => '请填写联系人姓名',
            'qq.required'    => '请填写QQ账号',
        ];
        $validator = validator()->make(request()->all(),$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $reault = auth()->user()->update(request()->all());
        if($reault){
            return $this->ajaxReturn('信息更新成功',1,route('user.index.index'));
        }else{
            return $this->ajaxReturn('信息更新失败',0);
        }
    }

    /**
     *  修改密码
     * @return $this
     */
    public function password(){
        return view('user.index.password');
    }

    /**
     * 更新密码
     */
    public function reset(){
        $data = request()->all();
        if($data['password-old']){
            if((\Hash::check($data['password-old'], auth()->user()->password)) === false){
                return response()->json(array('status'=>0,'info'=>'旧密码输入错误','id'=>'password-old'));
            }
        }
        $rules = [
            'password-old' => 'required',
            'password'  => 'required|min:6|confirmed',
        ];
        $msgs = [
            'password-old.required' => '请输入旧密码',
            'password.required' => '请输入密码',
            'password.min'      => '密码最少6位',
            'password.confirmed'=> '确认密码不一致',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $reault = auth()->user()->update(array('password'=>bcrypt($data['password'])));
        if($reault){
            return $this->ajaxReturn('修改密码成功',1,route('user.index.index'));
        }else{
            return $this->ajaxReturn('修改密码失败',0);
        }
    }





}
