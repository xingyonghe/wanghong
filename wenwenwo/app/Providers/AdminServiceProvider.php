<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redis;
use App\Model\Jurisdiction;
class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('admin.layouts.left', function ($view) {
//            $userid = getAdminSessionInfo('id');
            /*第一阶段不使用缓存系统，所以将数据存入session中
            //获取缓存目录缓存
            $moduleList = Redis::get('moduleList_'.$userid);
            if($moduleList){
                $admin_nav_list = json_decode($moduleList,true);
            }else{
                $role = Jurisdiction::getAuthList($userid);
                //将用户权限目录存入redis缓存
                Redis::set('moduleList_'.$userid,json_encode($role));
                Redis::expire('moduleList_'.$userid,60);
                $admin_nav_list = json_decode($role,true);
            }
            */
            $admin_nav_list = getAdminSessionInfo('moduleList');
            $view->with('admin_nav_list',$admin_nav_list);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
