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

class ConfigController extends Controller{

    protected $type = array();  //配置类型
    protected $group = array(); //配置分组

    public function __construct(){
        $this->type = array(
            '数字','字符','文本','数组','枚举','图片'
        );
        $this->group = array(
            '基本设置','SEO优化'
        );
    }

    /**
     * 网站配置
     */
    public function index(){
//        $map = array();
//        $title = Input::get('title') ?? '';
//        if(!empty($title)){
//            $map[] = ['title','like','%'.$title.'%'];
//        }
//        $datas = SysChannel::getLists($map);
//        $pages = array('title'=>$title);
//

        return view('admin.config.index');
    }

    /**
     * 新增
     */
    public function add(){
        $type =  $this->type;
        $group = $this->group;
        return view('admin.config.add',compact('type','group'));
    }

    /**
     * 编辑
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
     * 更新
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
     * 删除
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
     * 排序
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
