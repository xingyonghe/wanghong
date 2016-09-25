<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;
class AuthAdminMiddleware{

    /**
     * 后台权限检查
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin'){
        //是否登陆
        if (!Auth::guard($guard)->check()) {
            return redirect('admin');
        }
        return $next($request);
    }
}
