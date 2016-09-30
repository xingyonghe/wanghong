<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\SysAdmin;
use App\Model\SysRole;
use App\Model\SysPosition;
use App\Http\Requests\Admin\AdminListSaveRequest;

class AdminlistController extends Controller
{
    //后台员工列表
    public function index(){
        //获取用户信息
        $userinfo = SysAdmin::where('id','<>',5)->select('id','name','code','role_id','position_id','user_pin','phone','lock','login_ip','sort')->paginate(1);
        //获取所有权限组信息
        $role_list = SysRole::getSysRoleInfo();
        //获取所有职位信息
        $position_list = SysPosition::getSysPositionInfo();
        //组合信息
        foreach($userinfo as $k=>$v){
            $userinfo[$k]['role_name'] = $role_list[$v['role_id']];
            if($v['position_id'] == 0){
                $userinfo[$k]['position_name'] = '不需要职位';
            }else{
                $userinfo[$k]['position_name'] = $role_list[$v['position_id']];
            }
        }
//        print_r($userinfo);die;
        return view('admin.adminlist.index',compact('userinfo'));
    }

    //修改员工信息
    public function edit($id){
        //获取用户信息
        $info = SysAdmin::where(['id'=>$id])->select('id','name','code','role_id','position_id','user_name','user_pin','phone','lock','login_ip','sort')->first();
//        print_r($info);die;
        //获取所有权限组信息
        $role_list = SysRole::getSysRoleInfo();
        //获取所有职位信息
        $position_list = SysPosition::getSysPositionInfo();
        return view('admin.adminlist.edit',compact('info','role_list','position_list'));
    }

    //添加员工信息
    public function add(){
        //获取所有权限组信息
        $role_list = SysRole::getSysRoleInfo();
        //获取所有职位信息
        $position_list = SysPosition::getSysPositionInfo();
        return view('admin.adminlist.add',compact('role_list','position_list'));
    }

    //保存信息
    public function saveAdminlist(AdminListSaveRequest $request){
        $post = $request->except('_token');
        $post['sort'] = empty($post['sort'])?0:$post['sort'];
        if(isset($post['id'])){
            $id = (int) $post['id'];
        }
        if(isset($id) && $id > 0){
            //检测登录账号是否唯一
            if($this->check_sys_admin_unique($post['name'],$id)){
                return AjaxReturns('登录账号已存在');
            }
            //修改员工信息
            $result = SysAdmin::where(['id'=>$id])->update($post);
            if($result){
                return AjaxReturns('修改成功',1);
            }
            return AjaxReturns('修改失败');
        }else{
            //检测登录账号是否唯一
            if($this->check_sys_admin_unique($post['name'])){
                return AjaxReturns('登录账号已存在');
            }
            //新增的时候生成登录密码(以登录名加密为密码)
            $post['password'] = bcrypt($post['name']);
            //新增员工信息
            $result = SysAdmin::create($post);
            if($result){
                return AjaxReturns('添加成功',1);
            }
            return AjaxReturns('添加失败');
        }
    }

    /**
     * 删除账号信息
     */
    public function admin_list_Del(Request $request){
        $id = (int) $request->input('id','');
        if($id == 0){
            return AjaxReturns('删除错误');
        }
        //检测数据库中是否存在该id的数据，且未被删除
        $info = SysAdmin::where(['id'=>$id])->get();
        if($info->isEmpty()){
            return AjaxReturns('数据不存在');
        }
        $result = SysAdmin::where(['id'=>$id])->delete();
//        $result = SysAdmin::where(['id'=>$id])->update(['lock'=>99]);
        if($result){
            return AjaxReturns('删除成功',1);
        }
        return AjaxReturns('删除失败');
    }

    /*
     * 锁定、解锁
     */
    public function save_admin_list_status(Request $request){
        $id = (int) $request->input('id','');
        if($id == 0){
            return AjaxReturns('请求错误');
        }
        //检测数据库中是否存在该id的数据
        $info = SysAdmin::where(['id'=>$id])->first()->toArray();
        if(empty($info)){
            return AjaxReturns('数据不存在');
        }

        //获取将要修改后的状态
        $lock_status = 2;
        $return_info_name = '锁定';
        if($info['lock'] == 2){
            $lock_status = 1;
            $return_info_name = '解锁';
        }
        $result = SysAdmin::where(['id'=>$id])->update(['lock'=>$lock_status]);
        if($result){
            return AjaxReturns($return_info_name.'成功',1);
        }
        return AjaxReturns($return_info_name.'失败');
    }

    /*
     * 重置密码
     */
    public function admin_password_reset(Request $request){
        $id = (int) $request->input('id','');
        if($id == 0){
            return AjaxReturns('请求错误');
        }
        //检测数据库中是否存在该id的数据
        $info = SysAdmin::where(['id'=>$id])->first()->toArray();
        if(empty($info)){
            return AjaxReturns('数据不存在');
        }

        //生成重置后的密码
        $password = bcrypt($info['name']);
        $result = SysAdmin::where(['id'=>$id])->update(['password'=>$password]);
        if($result){
            return AjaxReturns('重置成功',1);
        }
        return AjaxReturns('重置失败');
    }


    /*
     * 检测用户登录名是否已存在，添加的时候检测是否已存在该账号，修改的时候检测是否存在id不为该信息id，但账号与修改后的一样的
     */
    public function check_sys_admin_unique($name,$id=''){
        if($id){
            $count = SysAdmin::where(['name'=>$name])->where('id','<>',$id)->count();
            if($count > 0){
                return true;
            }
        }else{
            $count = SysAdmin::where(['name'=>$name])->count();
            if($count > 0){
                return true;
            }
        }
    }
}
