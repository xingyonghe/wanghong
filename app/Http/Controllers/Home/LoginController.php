<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;//登陆成功跳转

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->redirectTo = route('home.index.index');
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * 登陆界面
     */
    public function showLoginForm(){
        return view('home.auth.login');
    }

    public function login(){
        //字段验证
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $msgs = [
            'username.required' => '请填写用户名',
            'password.required' => '请填写密码',
        ];
        $validator = validator()->make(request()->all(),$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }

        //从请求中获取所需的授权凭据。
        $credentials = request()->only('username', 'password');

        if ($this->guard()->attempt($credentials, request()->has('remember'))) {
            //记录登陆时间和登陆IP
            $user = $this->guard()->user();
            $data['login_time'] = date('Y-m-d H:i:s');
            $data['login_ip'] = request()->ip();
            D('User')->where('id',$user['id'])->update($data);
            request()->session()->regenerate();
            $this->clearLoginAttempts(request());
            return $this->ajaxReturn('',1,$this->redirectTo);
        }
        return response()->json(array('status'=>0,'info'=>'账户不存在或密码输入错误','id'=>'username'));
    }

    /**
     * 执行登陆成功
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLoginResponse($request){
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }


    /**
     * 退出登录
     * @param Request $request
     * @return mixed
     */
    public function logout(){
        $this->guard()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect(route('home.index.index'));
    }

    /**
     * 调用模型
     */
    protected function guard(){
        return \Auth::guard('web');
    }

}
