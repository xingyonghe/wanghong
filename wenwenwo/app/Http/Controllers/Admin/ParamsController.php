<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParamsPost;
use App\Model\Params;
use Redirect;
use Illuminate\Support\Facades\Input;

class ParamsController extends Controller{

    protected $type;//分类
    protected $cate;//类目
    protected $shape;//控件类型
    protected $map=array();

    public function __construct(){
        $this->type = array('' => '请选择','建筑施工' => '建筑施工', '建筑风水' => '建筑风水');
        $this->cate = array('' => '请选择','一级类目' => '一级类目', '一级类目' => '一级类目');
        $this->shape = array('0' => '请选择','1' => '单选', '2' => '多选', '3' => '下拉框');
    }

    /**
     * 参数列表
     */
    public function index(){
        $title = Input::get('title');
        $name  = Input::get('name');
        $cate  = Input::get('cate');
        $type  = Input::get('type');
        $shape  = Input::get('shape');
        if(!empty($title)){
            $this->map[] = array('title','like','%'.$title.'%');
        }
        if(!empty($name)){
            $this->map[] = array('name','like','%'.$name.'%');
        }
        if(!empty($cate)){
            $this->map[] = array('cate','like','%'.$cate.'%');
        }
        if(!empty($type)){
            $this->map[] = array('type','like','%'.$type.'%');
        }
        if(!empty($shape)){
            $this->map[] = array('shape','=',$shape);
        } 
        //分页参数
        $params = array(
            'title'=>$title,
            'name'=>$name,
            'type'=>$type,
            'cate'=>$cate,
            'shape'=>$shape
        );
        $datas = Params::list(1,$this->map);

        $shapeHtml = $this->shape;
        return view('admin.params.index',compact('datas','params','shapeHtml'));
    }

    /**
     * 新增参数
     * @return mixed
     */
    public function create(){
        $type = $this->type;
        $cate = $this->cate;
        $shape = $this->shape;
        return view('admin.params.create',compact('type','cate','shape'));
    }

    /**
     * 新增参数提交
     * @param ReminderPost $request
     * @return mixed
     */
    public function store(ParamsPost $request){
        $params = Params::create($request->all());
        if($params){
            return redirect('admin/parameter')->with('success', '新增成功！');
        }else{
            return Redirect::back()->withErrors(['error'=>'新增失败！','status'=>0]);
        }
    }

    /**
     * 修改参数
     * @return mixed
     */
    public function edit($id){
        if(empty($id) ||!is_numeric($id)){
            return Redirect::back()->withErrors(['error'=>'参数错误！','status'=>0]);
        }
        $info = Params::find($id);
        if(empty($info)){
            return Redirect::back()->withErrors(['error'=>'抱歉，你要查找的数据不存在！','status'=>0]);
        }
        $type = $this->type;
        $cate = $this->cate;
        $shape = $this->shape;
        return view('admin.params.edit',compact('info','type','cate','shape'));
    }

    /**
     * 更新参数
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(ParamsPost $request, $id){
        if(empty($id) ||!is_numeric($id)){
            return Redirect::back()->withErrors(['error'=>'参数错误！','status'=>0]);
        }
        $params = Params::findOrFail($id);
        $params->update(Input::get());
        if ($params->save()) {
            return redirect('admin/parameter')->with('success', '更新成功！');
        }else{
            return Redirect::back()->withErrors(['error'=>'更新失败！','status'=>0]);
        }
    }

    /**
     * 彻底删除
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        $destory = Params::findOrFail($id)->forceDelete();
        if($destory){
            return redirect('admin/parameter')->with('success', '删除成功！');
        }else{
            return Redirect::back()->withErrors(['error'=>'删除失败！','status'=>0]);
        }
    }
}
