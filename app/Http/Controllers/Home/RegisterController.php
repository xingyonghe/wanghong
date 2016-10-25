<?php

namespace App\Http\Controllers\Home;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest');
    }

    /**
     * 注册页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm(){
        return view('home.auth.register');
    }

    /**
     * 注册提交
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(){
        $validator = $this->validator(request()->all())->validate();
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error',$validator->messages()->first());
        }
        event(new Registered($user = $this->create(request()->all())));

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        $rules = [
            'type' => 'required',
            'username' => 'required|unique:user',
            'password' => 'required|min:6|confirmed',
            'nickname' => 'required',
            'qq'       => 'required',
            'protocol' => 'accepted'
        ];
        $msgs = [
            'type.required' => '类型必须选择',
            'username.required' => '请填写你要注册的手机号码',
            'username.unique' => '改手机号已经注册',
            'password.required' => '请输入密码',
            'password.min' => '密码最少6位',
            'password.confirmed' => '确认密码不一致',
            'nickname.required' => '请填写联系人姓名',
            'qq.required' => '请填写QQ号码',
            'protocol.accepted' => '您还没有阅读和同意注册协议',
        ];
        return Validator::make($data,$rules,$msgs );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
