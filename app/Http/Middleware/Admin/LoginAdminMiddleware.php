<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;
class LoginAdminMiddleware{

    /**
     * 后台登陆界面访问判断
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin'){

        //是否登陆
        if (Auth::guard($guard)->check()) {
            //登录成功
            return redirect('admin/index/index');
        }

        return $next($request);
    }
}
