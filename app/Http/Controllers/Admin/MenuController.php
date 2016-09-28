<?php

namespace App\Http\Controllers\Admin;

use App\Models\SysMenu;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Request;
use Redirect;
use App\Http\Requests\Admin\MenuRequest;
use Illuminate\Support\Facades\Input;
use URL;

class MenuController extends Controller{

    /**
     * 菜单列表
     */
    public function index(){
        $title = Input::get('title') ?? '';
        $pid = Input::get('pid') ?? 0;
        $map[] = ['pid','=',$pid];
        if(!empty($title)){
            $map[] = ['title','like','%'.$title.'%'];
        }
        $datas = SysMenu::getLists(20,$map);
        $pages = array('title'=>$title,'pid'=>$pid);
        return view('admin.menu.index',compact('datas','pages'));
    }

    /**
     * 菜单新增
     */
    public function add(){
        if(Request::ajax()){
            $pid = Input::get('pid') ?? 0;
            $menus = SysMenu::getMenus();
            $view = view('admin.menu.add',compact('menus','pid'));
            return Response::json(array('html'=>$view->render(),'status'=>1,'title'=>'新增菜单'));
        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 批量菜单新增
     */
    public function batch(){

    }

    /**
     * 批量菜单更新
     */
    public function batchUpdate(){

    }

    /**
     * 菜单修改
     */
    public function edit($id){
        if(Request::ajax()){
            $info = SysMenu::find($id);
            $menus = SysMenu::getMenus();
            $view = view('admin.menu.edit',compact('menus','info'));
            return Response::json(array('html'=>$view->render(),'status'=>1,'title'=>'修改菜单'));
        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 菜单更新
     * URL::previous() 获取上一次请求地址
     */
    public function update(MenuRequest $request){
        $res = SysMenu::updateData($request);
        if($res){
            return Response::json(array('success'=> $res['id']?'菜单信息修改成功':'菜单信息新增成功','status'=>1,'url'=>URL::previous()));
        }else{
            return Response::json(array('error'=> $res['id']?'菜单信息更新失败':'菜单信息新增失败','status'=>0));
        }
    }

    /**
     * 菜单删除
     */
    public function destroy($id){
        $datas = SysMenu::find($id);
        if($datas->delete()){
            return redirect()->back()->withSuccess('删除信息成功!');
        }else{
            return redirect()->back()->with('error','删除信息失败');
        }
    }




}
