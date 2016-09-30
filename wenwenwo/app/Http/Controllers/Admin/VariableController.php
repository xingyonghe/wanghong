<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReminderPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VariablePost;
use App\Model\Variable;
use Redirect;
use Validator;
use Illuminate\Support\Facades\Input;
class VariableController extends Controller{

    protected $map = array();
    public function __construct(){

    }

    /**
     * 常用变量列表
     */
    public function index(){
        $variable = Input::get('variable');
        $name  = Input::get('name');
        if(!empty($variable)){
            $this->map[] = array('variable','like','%'.$variable.'%');
        }
        if(!empty($name)){
            $this->map[] = array('name','like','%'.$name.'%');
        }
        //分页参数
        $params = array('variable'=>$variable,'name'=>$name);
        $datas = Variable::list(5,$this->map,array('created_at','asc'));
        return view('admin.variable.index',compact('datas','variable','name','params'));
    }

    /**
     * 新增变量
     * @return mixed
     */
    public function create(){
        return view('admin.variable.create');
    }

    /**
     * 新增变量提交
     * @param ReminderPost|VariablePost $request
     * @return mixed
     */
    public function store(VariablePost $request){
        $variable = Variable::create($request->all());
        if($variable){
            return redirect('admin/variable')->with('success', '新增成功！');
        }else{
            return Redirect::back()->withErrors(['error'=>'新增失败！','status'=>0]);
        }
    }

    /**
     * 修改变量
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
     * 更新变量
     * @param VariablePost|Request $request
     * @param $id
     * @return mixed
     */
    public function update(VariablePost $request, $id){
        if(empty($id) ||!is_numeric($id)){
            return Redirect::back()->withErrors(['error'=>'参数错误！','status'=>0]);
        }
        $variable = Variable::findOrFail($id);
        $variable->update(Input::get());
        if ($variable->save()) {
            return redirect('admin/variable')->with('success', '更新成功！');
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
        $destory = Variable::findOrFail($id)->forceDelete();
        if($destory){
            return redirect('admin/variable')->with('success', '删除成功！');
        }else{
            return Redirect::back()->withErrors(['error'=>'删除失败！','status'=>0]);
        }
    }
}
