<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Library\Auth as AdminAuth;
use Response;

class AuthAdminMiddleware{
    use AdminAuth;

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
        //是否有权限
        if($this->checkRules()){
            return $next($request);
        }else{
            if($request->ajax()){
                return Response::json(array('error'=>'抱歉，您的权限不足','status'=>0));
            }else{
                return redirect()->back()->with('error','抱歉，您的权限不足');
            }

        }
    }
}
