<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\SysMenu;
use Request;
use App\Library\Auth as AdminAuth;
class MenuAdminMiddleware{
    use AdminAuth;


    public function handle($request, Closure $next, $guard = 'admin'){
//        dd($this->getMenu());
        view()->share('menus',$this->getMenu());//share()，分享数据给所有视图，参数一代表键，参数二代表值
        return $next($request);
    }

    /**
     * 返回后台用户权限菜单，存入session
     * @return array
     */
    public function getMenu(){
        //获取当前URL菜单
        $urlResault = explode('/',Request::route()->getUri());
        $routeUrl = $urlResault[0].'/'.$urlResault[1].'/'.$urlResault[2];//只取前三位组成菜单，其他参数部分过滤
        $menus = session()->get('ADMIN_MENU_LIST.'.$urlResault[1]);//加上控制器的名称用来区分都不菜单的子菜单
        if(empty($menus)){
            //获取用户角色ID
            $userGroupId = Auth::guard('admin')->user()->role_id;
            //获取用户角色的所有权限
            $access = $this->getRules($userGroupId);
            //获取所有菜单
            $menus = array();
            $menus['main'] = SysMenu::select('id','title','url','icon')->where(array(['pid','=',0],['hide','=',0]))->orderBy('sort','asc')->get()->toArray();
            //检查权限。保留用户有权限的菜单
            foreach($menus['main'] as $key=>$item){
                if(!in_array($item['url'],$access)){
                    unset($menus['main'][$key]);
                    continue;//继续循环
                }
            }
            //查找当前的链接的PID信息
            $parent = SysMenu::select('pid')->where(array(['pid','>','0'],['url','=',$routeUrl]))->first();
            if($parent && $parent->pid){
                // 查找当前主菜单,菜单只分三级
                $nav =  SysMenu::find($parent->pid);
                if($nav->pid){
                    $nav = SysMenu::find($nav->pid);
                }
            }else{
                //当不存在父级的时候，代表访问的是首页
                $nav = SysMenu::find(1);
            }
            foreach($menus['main'] as $key=>$item){
                if($nav->id == $item['id']){
                    $menus['main'][$key]['current'] = 'active';
                    //生成child 树
                    $groups = SysMenu::select('group')->where(array(['group','<>',''],['pid','=',$item['id']]))->get();
                    foreach ($groups as $g) {
                        $menuList = SysMenu::select('id','title','pid','url','icon')->where(array(['group','=',$g->group],['hide','=',0],['pid','=',$item['id']]))->orderBy('sort','asc')->get()->toArray();
                        foreach($menuList as $k=>$list){
                            if(!in_array($list['url'],$access)){
                                unset($menuList[$k]);
                                continue;//继续循环
                            }
                        }
                        $menus['child'][$g->group] = $menuList;
                    }
                }else{
                    $menus['main'][$key]['current'] = '';
                }
            }
            session()->put('ADMIN_MENU_LIST.'.$urlResault[1],$menus);
        }
        return $menus;
    }
}
