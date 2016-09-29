<?php

namespace App\Http\Controllers\Admin;

use App\Models\SysConfig;
use App\Http\Controllers\Controller;
use Response;
use Request;
use Illuminate\Http\Request as HttpRequest;
use App\Http\Requests\Admin\ConfigRequest;
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
        $map = array();
        $title = Input::get('title') ?? '';
        if(!empty($title)){
            $map[] = ['title','like','%'.$title.'%'];
        }
        $datas = SysConfig::getLists($map);
        $pages = array('title'=>$title);
        return view('admin.config.index',compact('datas','pages'));
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
        if(empty($id) || !is_numeric($id)){
            return redirect()->back()->with('error','参数错误');
        }
        $type =  $this->type;
        $group = $this->group;
        $info = SysConfig::find($id);
        if(empty($info)){
            return redirect()->back()->with('error','抱歉，您要查找的数据不存在');
        }
        return view('admin.config.edit',compact('info','type','group'));
    }

    /**
     * 更新
     * URL::previous() 获取上一次请求地址
     */
    public function update(ConfigRequest $request){
        $res = SysConfig::updateData($request);
        if($res){
            return redirect('admin/config/index')->withSuccess($res['id']?'配置信息修改成功':'配置信息新增成功');
        }else{
            return redirect()->back()->with('error',$res['id']?'配置信息更新失败':'配置信息新增失败');
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
