<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: luofei614 <weibo.com/luofei614>　
// +----------------------------------------------------------------------
namespace App\Library;
use DB;
use Request;
use Illuminate\Support\Facades\Auth as LoginAuth;
trait Auth{
    /**
     * 用户角色权限
     * @param $userGroupId
     * @return array
     */
    protected function getRules($userGroupId){
        $rulesData = DB::table('sys_auth_group')->where('id',$userGroupId)->first();
        $rules = json_decode($rulesData->rules);
        $roles = DB::table('sys_auth_rule')->whereIn('id',$rules)->pluck('name', 'id')->toArray();
        return $roles;
    }

    /**
     * 用户角色权限检查
     */
    protected function checkRules(){
        $user = LoginAuth::guard('admin')->user();
        $roles = $this->getRules($user->role_id);
        //获取当前URL菜单
        $urlResault = explode('/',Request::route()->getUri());
        $routeUrl = $urlResault[0].'/'.$urlResault[1].'/'.$urlResault[2];//只取前三位组成菜单，其他参数部分过滤
        if(in_array($routeUrl,$roles)){
            return true;
        }else{
            return false;
        }
    }

}
