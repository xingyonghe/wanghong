<?php

namespace App\Http\Controllers\Admin;

use App\Model\SysMessageCategory;
use App\Model\Variable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SysMessage;
use DB;

class MessageController extends Controller{

    protected $map = array();
    public function __construct(){

    }

    /**
     * 站内消息列表
     */
    public function index(){
        $datas = SysMessage::getList();
        return view('admin.message.index',compact('datas'));
    }

    /**
     * 新增站内消息
     * @return mixed
     */
    public function add(){
        $category = SysMessageCategory::getMessageCategory();
        $category[0] = '请选择';
        ksort($category);
        return view('admin.message.create',compact('category'));
    }

    /**
     * 修改
     * @return mixed
     */
    public function edit($id){
        if(empty($id) ||!is_numeric($id)){
            return Redirect::back()->withErrors(['error'=>'参数错误！','status'=>0]);
        }
        $info = Variable::find($id);
        if(empty($info)){
            return Redirect::back()->withErrors(['error'=>'抱歉，你要查找的数据不存在！','status'=>0]);
        }
        return view('admin.variable.edit',compact('info'));
    }


    /**
     * 详情
     * @param $id
     * @return mixed
     */
    public function show($id){
        if(empty($id) ||!is_numeric($id)){
            return redirect()->back()->withErrors(['error'=>'参数错误！','status'=>0]);
        }
        $info = SysMessage::find($id);
        $user = DB::table('sys_admin')->where(array(['id','=',$info->user_id]))->first();
        $category = SysMessageCategory::getMessageCategory();
        $statusText = array('0'=>'未读','1'=>'已读','99'=>'删除');
        $info->category = $category[$info->message_catid];
        $info->statusText = $statusText[$info->status];
        $info->username = $user->name;
        if(empty($info)){
            return redirect()->back()->withErrors(['error'=>'抱歉，你要查找的数据不存在！','status'=>0]);
        }
        return view('admin.message.show',compact('info'));
    }


    /**
     * 删除
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        $info = SysMessage::find($id);
        $res = $info->update(array('status'=>99));
        if($res){
            return redirect()->back()->with('success', '删除成功！');
        }else{
            return redirect()->back()->withErrors(['error'=>'删除失败！','status'=>0]);
        }
    }

    /**
     * 更新
     * @param VariablePost|Request $request
     * @param $id
     * @return mixed
     */
    public function post(Request $request){
        $rules = [
            'message_catid' => 'positive',
            'name' => 'required',
            'title' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'message_catid.positive' => '请选择分类',
            'name.required' => '请填写收件人',
            'title.required' => '请填写信息标题',
            'content.required' => '请填写信息内容',
        ];
        $this->validate($request,$rules,$messages);
        $name = $request->name;
        $name = explode(';',$name);

        foreach($name as $k=>$val){
            $res = DB::table('sys_admin')->where(array(['name','=',$val]))->first();
            if($res){
                $user[] = $res->id;
            }
        }
        if(isset($user)){
            foreach($user as $userid){
                //userid,标题，内容，分类
                send_esssage($userid,$request->title,$request->content,$request->message_catid);
            }
            return redirect('admin/message/index')->withSuccess('发送成功！');
        }else{
            return redirect()->back()->withInput()->withErrors(['error'=>'账号信息不存在！','status'=>0]);
        }

    }



    /**
     * 分类管理
     */
    public function category(){
        $datas = SysMessageCategory::getList();
        return view('admin.message.category',compact('datas'));
    }

    /**
     * 新增消息分类
     */
    public function addMessageCategory(){
        return view('admin.message.category_add');
    }

    /**
     * 编辑消息分类
     */
    public function editMessageCategory($id){
        if(empty($id) ||!is_numeric($id)){
            return redirect()->back()->withErrors(['error'=>'参数错误！','status'=>0]);
        }
        $info = SysMessageCategory::find($id);
        if(empty($info)){
            return redirect()->back()->withErrors(['error'=>'抱歉，你要查找的数据不存在！','status'=>0]);
        }
        return view('admin.message.category_edit',compact('info'));
    }


    /**
     * 添加消息分类
     * @param Request $request
     */
    public function postMessageCategory(Request $request){
        if(empty($request->name)){
            return redirect()->back()->withInput()->withErrors(['error'=>'请填写分类名称','status'=>0]);
        }
        $res = SysMessageCategory::uodateData($request);
        if($res){
            return redirect('admin/message/category')->withSuccess($res['id']?'修改分类名称成功':'添加分类名称成功');
        }else{
            return redirect()->back()->withErrors(['error'=>$res['id']?'修改分类名称失败':'添加分类名称失败','status'=>0]);
        }
    }

    /**
     * 彻底删除
     * @param $id
     * @return mixed
     */
    public function destroyMessageCategory($id){
        $destory = SysMessageCategory::findOrFail($id)->forceDelete();
        if($destory){
            return redirect('admin/message/category')->withSuccess('删除成功！');
        }else{
            return redirect()->back()->withErrors(['error'=>'删除失败！','status'=>0]);
        }
    }























}
