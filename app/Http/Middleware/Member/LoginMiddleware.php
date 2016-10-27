<?php

namespace App\Http\Middleware\Member;

use Closure;
use Illuminate\Support\Facades\Auth;
class LoginMiddleware{

    /**
     * 后台登陆界面访问判断
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = ''){

        //是否登陆
        if (Auth::guard($guard)->check()) {
            //登录成功
            return $next($request);
        }
        return redirect(route('auth.login.form'));

    }
}
