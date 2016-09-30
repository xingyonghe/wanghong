<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\SysNode;
use App\Model\SysRole;
use App\Http\Requests\Admin\SavePasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Model\SysAdmin;
class AccessController extends Controller
{
   /*
    * 系统节点设置开始
    */
    public function index(){
        return view('admin.access.index');
    }

    /*
     * 系统节点列表
     */
    public function nodeList(){
//        $url = action('Admin\AccessController@nodeModif');
//        $url2 = action('Home\IndexController@aaa');
        $firstNode = SysNode::where('rank','<=','1')
            ->where('status','<>',-1)
            ->select('id','name')->get()->toArray();
        $nodeList = SysNode::where('status','<>',-1)
            ->select('id','pid','name')->get();
        $nodeList['0']['open'] = true;
        $nodeList = $nodeList->toJson();
        return view('admin.access.nodeList',compact('firstNode','nodeList'));
    }

    /*
     * 修改节点列表
     */
    public function nodeModif(Request $request){
        $isedit = $request->input('save',0);
        if ($isedit) {
            $post = $request->except('_token');
            $id = (int) $post['id'];
            $name = $post['name'];
            unset($post['save']);
            if(empty($name)){
                return AjaxReturns('节点名称必须');
            }
            if($post['code']){
                $code = $post['code'];
                unset($post['code']);
                $post['code'] = strtolower($code);
                if(SysNode::where('id','<>',$id)->where(['code'=>$post['code']])->count()){
                    return AjaxReturns('链接地址已存在');
                }
            }
            if($this->check_sys_node_unique($post['name'],$id)){
                return AjaxReturns('节点名称已存在');
            }
            $result = SysNode::where(['id'=>$id])->update($post);
            if($result){
                return AjaxReturns('修改成功',1);
            }
            return AjaxReturns('修改失败');
        }else{
            $id = (int) $request->input('id','');
            if(empty($id)){
                return AjaxReturns('请求出错');
            }
            $info = SysNode::where(['id'=>$id])->first()->toArray();
            return view('admin.access.nodeModif',compact('info'));
        }
    }

    public function getSecondNode(Request $request){
        $id = $request->input('id');
        if ($id) {
            $twoNode = SysNode::where(['pid'=>$id])->where('status','<>',-1)->select('id','name')->get()->toArray();
            if ($twoNode) {
                return view('admin.access.getSecondNode',compact('twoNode'));
            }
        }
    }

    /*
     * 添加节点
     */
    public function nodeAdd(Request $request){
        $post = $request->except('_token');
        $name = $post['name'];

        if(empty($name)){
            return AjaxReturns('节点名称必须');
        }
        $pid = $post['pid'];
        unset($post['pid']);
        //键值倒序
        krsort($pid);
        //获取第一个有效值
        foreach ($pid as $val) {
            if ($val) {
                $post['pid'] = $val;
                break;
            }
        }
        if($this->check_sys_node_unique($post['name'])){
            return AjaxReturns('节点名称已存在');
        }
        if($post['pid'] <= 1){
            $post['rank'] = 1;
        }else{
            //获取该信息父级的父级
            $this_pid = SysNode::where(['id'=>$post['pid']])->value('pid');
            if($this_pid = 0){
                $post['rank'] = 2;
            }else{
                $post['rank'] = 3;
            }
        }
        $post['sort'] = (int) $post['sort'];
        $result = SysNode::create($post);
        if($result){
            return AjaxReturns('添加成功',1);
        }
        return AjaxReturns('添加失败');
    }

    /*
     * 检测节点名称是否已存在，添加的时候检测是否已存在该节点名称，修改的时候检测是否存在id不为该节点id，但节点名称与修改后的一样的
     */
    public function check_sys_node_unique($title,$id=''){
        if($id){
            $count = SysNode::where(['name'=>$title])->where('id','<>',$id)->where('status','<>',-1)->count();
            if($count > 0){
                return true;
            }
        }else{
            $count = SysNode::where(['name'=>$title])->where('status','<>',-1)->count();
            if($count > 0){
                return true;
            }
        }
    }

    /**
     * 删除节点
     */
    public function nodeDel(Request $request){
        $id = (int) $request->input('id','');
        if($id == 0){
            return AjaxReturns('删除错误');
        }
        //检测数据库中是否存在该id的数据，且未被删除
        $info = SysNode::where(['id'=>$id])->where('status','<>',-1)->get();
        if($info->isEmpty()){
            return AjaxReturns('数据不存在');
        }
        $result = SysNode::where(['id'=>$id])->update(['status'=>-1]);
        if($result){
            return AjaxReturns('删除成功',1);
        }
        return AjaxReturns('删除失败',1);
    }
    /*
     * 系统节点设置结束；后台权限组管理开始
     */
    //权限组列表
    public function roleList(){
        $roleList = SysRole::orderBy('sort', 'desc')->where('authority','<>',-1)->paginate(1);
//        $roleList = SysRole::orderBy('sort', 'desc')->where('authority','<>',-1)->simplePaginate(1);
        return view('admin.rolelist.rolelist',compact('roleList'));
//        return view('admin.rolelist.roleEdit',compact('roleList'));
    }

    //修改权限信息
    public function roleEdit($id){
            //获取所有权限节点
            $nodeList = SysNode::where('status','<>',-1)
                ->select('id','pid','name')->get();
            $nodeList['0']['open'] = true;
            $nodeList = $nodeList->toJson();
            //获取当前权限组的权限节点
            $info = SysRole::where(['id'=>$id])->first()->toArray();
            return view('admin.rolelist.roleEdit',compact('nodeList','info'));
    }

    //新增权限组
    public function roleAdd(){
        //获取所有权限节点
        $nodeList = SysNode::where('status','<>',-1)
            ->select('id','pid','name')->get();
        $nodeList['0']['open'] = true;
        $nodeList = $nodeList->toJson();
        return view('admin.rolelist.roleAdd',compact('nodeList'));
    }

    public function saveRole(Request $request){
        $post = $request->except('_token');
        if(isset($post['id'])){
            $id = (int) $post['id'];
        }
        $name = $post['name'];
        if(empty($name)){
            return AjaxReturns('角色名称必须');
        }
        if(isset($id) && $id > 0){
           //修改权限组
            $result = SysRole::where(['id'=>$id])->update($post);
            if($result){
                return AjaxReturns('修改成功',1);
            }
            return AjaxReturns('修改失败');
        }else{
            //新增权限组
            $result = SysRole::create($post);
            if($result){
                return AjaxReturns('添加成功',1);
            }
            return AjaxReturns('添加失败');
        }
    }

    //修改密码
    public function password_edit(){
        return view('admin.access.password_edit');
    }

    //保存密码
    public function password_save(SavePasswordRequest $request){
        $post = $request->except('_token');
        $userid = getAdminSessionInfo('id');
        $userinfo = SysAdmin::where(['id'=>$userid])->select('id','name','password')->first()->toArray();
        if (Hash::check($post['old_pass'], $userinfo['password'])) {
            if (Hash::check($post['password'], $userinfo['password'])){
                return AjaxReturns('新密码不能与原密码相同');
            }else{
                $new_password = bcrypt($post['password']);
                $result = SysAdmin::where(['id'=>$userid])->update($new_password);
                if($result){
                    return AjaxReturns('修改成功',1);
                }else{
                    return AjaxReturns('修改失败');
                }
            }

        }else{
            return AjaxReturns('原密码错误');
        }
    }

}
