<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;

class AdminHasloginMiddleware
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
       /* Config::set('auth.model', 'App\SysAdmin');
        Config::set('auth.table', 'sys_admin');
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/public/login');
            }
        }
        return $next($request);*/
        $admin_session_prefix = config('admin_config.SESSION_ADMIN_PREFIX');
        $check_login = session($admin_session_prefix);
        if($check_login){
            return redirect()->guest('/admin');
        }else{
            return $next($request);
        }
    }
}
