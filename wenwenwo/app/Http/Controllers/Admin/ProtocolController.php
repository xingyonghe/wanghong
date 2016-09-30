<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProtocolRequest;
use App\Model\SysProtocol;
use Redirect;
use Illuminate\Support\Facades\Input;

class ProtocolController extends Controller{

    /**
     * 协议控制器
     */
    protected $map = array();

    public function __construct(){

    }

    /**
     * 协议列表
     */
    public function index(){
        $title = Input::get('title');
        $name  = Input::get('name');
        if(!empty($title)){
            $this->map[] = array('title','like','%'.$title.'%');
        }
        if(!empty($name)){
            $this->map[] = array('name','like','%'.$name.'%');
        }
        //分页参数
        $params = array(
            'title' => $title,
            'name'  => $name,
        );
        $datas = SysProtocol::getList(5,$this->map);

        return view('admin.protocol.index',compact('datas','params'));
    }

    /**
     * 新增协议
     * @return mixed
     */
    public function add(){
        return view('admin.protocol.create');
    }

    /**
     * 修改
     * @return mixed
     */
    public function edit($id){
        if(empty($id) ||!is_numeric($id)){
            return Redirect::back()->withErrors(['error'=>'参数错误！','status'=>0]);
        }
        $info = SysProtocol::find($id);

        if(empty($info)){
            return Redirect::back()->withErrors(['error'=>'抱歉，你要查找的数据不存在！','status'=>0]);
        }
        return view('admin.protocol.edit',compact('info'));
    }

    /**
     * 新增/修改提交
     * @param ProtocolRequest $request
     * @return $this
     */
    public function update(ProtocolRequest $request){
        $res = SysProtocol::updateData($request);
        if($res){
            return redirect('admin/protocol/index')->with('success', $res['id']?'协议信息修改成功':'协议信息新增成功');
        }else{
            return Redirect::back()->withErrors(['error'=>$res['id']?'协议信息更新失败':'协议信息新增失败','status'=>0]);
        }
    }




    /**
     * 彻底删除
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        $destory = SysProtocol::findOrFail($id)->forceDelete();
        if($destory){
            return redirect('admin/protocol/index')->with('success', '删除协议信息成功！');
        }else{
            return redirect()->back()->withErrors(['error'=>'删除协议信息失败！','status'=>0]);
        }
    }
}
