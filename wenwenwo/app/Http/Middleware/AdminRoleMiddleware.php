<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Jurisdiction;
class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /***********************************用户权限检测**********************************************/
        //获取当前用户请求的链接地址
        $RequestUri = $request->getRequestUri();
        $request_url_array = explode('?',ltrim ($RequestUri,'/'));
        $request_url = $request_url_array[0];


        //获取用户所有权限
        $userid = getAdminSessionInfo('id');
        $old_role = Jurisdiction::get_this_AuthList($userid);
        $new_role = [];
        foreach($old_role as $k=>$v){
            $new_role[$v['id']] = $v['code'];
        }
        //检测当前用户是否拥有请求该链接的权限
        $check_result = array_search($request_url,$new_role);
//        print_r($new_role);die;
        if($check_result){
            return $next($request);
        }else{
            if ($request->ajax() || $request->wantsJson()) {
                return AjaxReturns('权限不足');
            }
            abort(404, '访问的页面不存在或你的权限不足');
        }
        /*******************************************************************************************/

    }
}
