<?php

namespace App\Http\Controllers\Admin;

use App\Models\SysChannel;
use App\Http\Controllers\Controller;
use Response;
use Request;
use Illuminate\Http\Request as HttpRequest;
use App\Http\Requests\Admin\ChannelRequest;
use Illuminate\Support\Facades\Input;
use URL;

class ChannelController extends Controller{

    /**
     * 导航列表
     */
    public function index(){
        $map = array();
        $title = Input::get('title') ?? '';
        if(!empty($title)){
            $map[] = ['title','like','%'.$title.'%'];
        }
        $datas = SysChannel::getLists($map);
        $pages = array('title'=>$title);
        return view('admin.channel.index',compact('datas','pages'));
    }

    /**
     * 导航新增
     */
    public function add(){
        if(Request::ajax()){
            $view = view('admin.channel.add');
            return Response::json(array('html'=>$view->render(),'status'=>1,'title'=>'新增导航'));
        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 导航修改
     */
    public function edit($id){
        if(Request::ajax()){
            $info = SysChannel::find($id);
            $view = view('admin.menu.edit',compact('info'));
            return Response::json(array('html'=>$view->render(),'status'=>1,'title'=>'修改导航'));
        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 导航更新
     * URL::previous() 获取上一次请求地址
     */
    public function update(ChannelRequest $request){
        $res = SysChannel::updateData($request);
        if($res){
            return Response::json(array('success'=> $res['id']?'导航信息修改成功':'导航信息新增成功','status'=>1,'url'=>URL::previous()));
        }else{
            return Response::json(array('error'=> $res['id']?'导航信息更新失败':'导航信息新增失败','status'=>0));
        }
    }

    /**
     * 导航删除
     */
    public function destroy($id){
        $datas = SysChannel::find($id);
        if($datas->delete()){
            return redirect()->back()->withSuccess('删除信息成功!');
        }else{
            return redirect()->back()->with('error','删除信息失败');
        }
    }

    /**
     * 导航排序
     */
    public function sort(){
        if(Request::ajax()){
            $datas = SysChannel::orderBy('sort','asc')->get()->toArray();
            $view = view('admin.channel.sort',compact('datas'));
            return Response::json(array('html'=>$view->render(),'status'=>1,'title'=>'导航排序'));
        }else{
            return redirect()->back()->with('error','请求超时');
        }
    }

    /**
     * 更新排序
     * @param Request $request
     */
    public function postSort(HttpRequest $request){
        $ids = $request->ids;
        $ids = explode(',', $ids);
        foreach ($ids as $sort=>$id){
            $channel = SysChannel::find($id);
            $res = $channel->update(array('sort'=>$sort+1));
        }
        return Response::json(array('success'=> '导航信息排序成功','status'=>1,'url'=>URL::previous()));
    }




}
