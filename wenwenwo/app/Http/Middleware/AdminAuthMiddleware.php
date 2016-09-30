<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use App\Model\Jurisdiction;
class AdminAuthMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin_session_prefix = config('admin_config.SESSION_ADMIN_PREFIX');
        $check_login = session($admin_session_prefix);
        if(empty($check_login)){
            return redirect()->guest('admin/public/login');
        }else{
            /*$userid = getAdminSessionInfo('id');
            第一阶段不使用缓存系统，所以将数据存入session中
            //获取缓存目录缓存
            $moduleList = Redis::get('moduleList_'.$userid);
            //如果目录缓存不存在，就生成
            if(empty($moduleList)){
                $role = Jurisdiction::getAuthList($userid);
                //将用户权限目录存入redis缓存
                Redis::set('moduleList_'.$userid,json_encode($role));
                Redis::expire('moduleList_'.$userid,60);
            }
            */
            return $next($request);
        }
    }
}
