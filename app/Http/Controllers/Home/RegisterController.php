<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class RegisterController extends Controller{

    public function __construct(){
        $this->middleware('guest');
    }

    /**
     * 注册页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm(){
        $type = [1 => '主播', 2=> '广告主'];//注册角色
        $checkd = 1;//默认选中
        if(empty(C('WEB_REGISTER_AD'))){
            unset($type[2]);
        }
        if(empty(C('WEB_REGISTER_USER'))){
            unset($type[1]);
            $checkd = 2;
        }
        return view('home.auth.register',compact('type','checkd'));
    }

    /**
     * 注册提交
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(){
        //数据验证
        $validator = $this->validator(request()->all());
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }

        //随机分配客服信息
        $admin = D('SysAdmin')->where(array(['id','>',1]))->orderBy(\DB::raw('RAND()'))->take(1)->first();
        $data = request()->all();
        $data['password']    = bcrypt($data['password']);
        $data['custom_id']   = $admin['id'];
        $data['custom_name'] = $admin['nickname'];
        $data['is_auth']     = 1;
        if(C('WEB_REGISTER_VERIFY')){
            $data['status']  = 2;
        }else{
            $data['status']  = 1;
        }
        $data['reg_time']    = date('Y-m-d H:i:s',time());
        $data['reg_ip']      = request()->ip();
        $user = D('User')::create($data);
        if($user->exists){
            return $this->ajaxReturn('恭喜您，注册成功',1,route('home.login-form'));
        }
        return $this->ajaxReturn('注册失败',0);
    }
    /**
     * 表单验证
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        if($data['type'] == 2){
            $rules = [
                'username' => 'required|mobile|unique:user',
                'password' => 'required|min:6|confirmed',
                'nickname' => 'required',
                'company'  => 'required',
                'protocol' => 'accepted'
            ];
            $msgs = [
                'username.required' => '请填写你要注册的手机号码',
                'username.mobile'   => '手机号格式错误',
                'username.unique'   => '手机号已经注册',
                'password.required' => '请输入密码',
                'password.min'      => '密码最少6位',
                'password.confirmed'=> '确认密码不一致',
                'nickname.required' => '请填写联系人姓名',
                'company.unique'    => '请填写公司名称',
                'protocol.accepted' => '您还没有阅读和同意注册协议',
            ];
        }else{
            $rules = [
                'username' => 'required|mobile|unique:user',
                'password' => 'required|min:6|confirmed',
                'nickname' => 'required',
                'qq'       => 'required',
                'protocol' => 'accepted'
            ];
            $msgs = [
                'username.required' => '请填写你要注册的手机号码',
                'username.mobile' => '手机号格式错误',
                'username.unique' => '手机号已经注册',
                'password.required' => '请输入密码',
                'password.min' => '密码最少6位',
                'password.confirmed' => '确认密码不一致',
                'nickname.required' => '请填写联系人姓名',
                'qq.required' => '请填写QQ号码',
                'protocol.accepted' => '您还没有阅读和同意注册协议',
            ];
        }
        return validator()->make($data,$rules,$msgs);
    }

}
