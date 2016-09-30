<?php

namespace App\Http\Controllers\Admin;
use App\Model\SysAdmin;
use App\Model\Jurisdiction;
use Hash;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;

class PublicController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function login(){
        return view('admin.public.login');
    }

    public function register(){
        return view('admin.public.register');
    }

    public function postLogin(UserLoginRequest $request){
        $data = $request->all();
        $where['name'] = $data['username'];
        $userinfo = SysAdmin::where($where)->select('id','name','password')->get();

        if($userinfo->isEmpty()){
            return AjaxReturns('账号不存在');
        }
        //将从数据库中查询出来的信息转换为数组格式
        $user_info_arr = head($userinfo->toArray());
        /*laravel自带加密校验*/
        $admin_session_prefix = config('admin_config.SESSION_ADMIN_PREFIX');
        if (Hash::check($data['password'], $user_info_arr['password'])) {
            SysAdmin::where(['id'=>$user_info_arr['id']])->update(['login_ip'=>$_SERVER['REMOTE_ADDR']]);

            /*
             * 第一版不使用缓存登录处理方式
             */
            $userid = $user_info_arr['id'];
            $role = Jurisdiction::getAuthList($userid);
            $user_info_arr['moduleList'] = $role;
            session([$admin_session_prefix=>$user_info_arr]);

            //将用户信息存入session
//            session([$admin_session_prefix=>$user_info_arr]);
            //获取登录用户管理模块
            /**/
//            $userid = getAdminSessionInfo('id');
//            $role = Jurisdiction::getAuthList($userid);
            /*
             * //将用户权限目录存入redis缓存,本阶段不使用缓存，所以用户权限存为session
                Redis::set('moduleList_'.$userid,json_encode($role));
                Redis::expire('moduleList_'.$userid,60);
           */

            /**/
            return AjaxReturns('登录成功',1);

        }else{
            return AjaxReturns('账号或密码错误');
        }

       /* md5加密校验
       if (!strcmp(md5($data['password'].config('app.key')), $user_info_arr['password'])) {
            SysAdmin::where(['id'=>$user_info_arr['id']])->update(['login_ip'=>$_SERVER['REMOTE_ADDR']]);
            session(['userinfo'=>$user_info_arr]);
            return AjaxReturns('登录成功',1);
        }else{
            return AjaxReturns('账号或密码错误');
        }*/
    }

//    public function postRegister(Request $request){

//    }
    public function logout()
    {
       $admin_session_prefix = config('admin_config.SESSION_ADMIN_PREFIX');
        session([$admin_session_prefix=>null]);
        //退出的同时，清除当前用户的权限目录缓存
//        $userid = getAdminSessionInfo('id');
//        Redis::del('moduleList_'.$userid);
        return redirect()->route('admin_login');
    }
}
