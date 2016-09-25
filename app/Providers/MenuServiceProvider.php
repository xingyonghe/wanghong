<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SysMenu;

class MenuServiceProvider extends ServiceProvider{

    /**
     *  菜单服务容器
     * @return void
     */
    public function boot(){
        view()->composer(['admin.public.menu','admin.public.head'], function ($view) {
            $menus = SysMenu::getAuthMenus();
            $view->with('menus',$menus);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(){
        //
    }
}
