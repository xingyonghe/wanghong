<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReminderPost;
use App\Model\Reminder;
use Redirect;
use Illuminate\Support\Facades\Input;
class ReminderController extends Controller{

    protected $map = array();
    public function __construct(){

    }

    /**
     * 提示语列表
     */
    public function index($title='',$name=''){
        $title = Input::get('title');
        $name  = Input::get('name');
        if(!empty($title)){
            $this->map[] = array('title','like','%'.$title.'%');
        }
        if(!empty($name)){
            $this->map[] = array('name','like','%'.$name.'%');
        }
        //分页参数
        $params = array('title'=>$title,'name'=>$name);

        $datas = Reminder::list(5,$this->map);
        return view('admin.reminder.index',compact('datas','title','name','params'));
    }

    /**
     * 新增提示语
     * @return mixed
     */
    public function create(){
        return view('admin.reminder.create');
    }

    /**
     * 新增提示语提交
     * @param ReminderPost $request
     * @return mixed
     */
    public function store(ReminderPost $request){
        $reminder = Reminder::create($request->all());
        if($reminder){
            return redirect('admin/reminder')->with('success', '新增提示语成功！');
        }else{
            return Redirect::back()->withErrors(['error'=>'新增提示语失败！','status'=>0]);
        }
    }

    /**
     * 修改提示语
     * @return mixed
     */
    public function edit($id){
        if(empty($id) ||!is_numeric($id)){
            return Redirect::back()->withErrors(['error'=>'参数错误！','status'=>0]);
        }
        $info = Reminder::find($id);
        if(empty($info)){
            return Redirect::back()->withErrors(['error'=>'抱歉，你要查找的数据不存在！','status'=>0]);
        }
        return view('admin.reminder.edit',compact('info'));
    }

    /**
     * 更新提示语
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(ReminderPost $request, $id){
        if(empty($id) ||!is_numeric($id)){
            return Redirect::back()->withErrors(['error'=>'参数错误！','status'=>0]);
        }
        $reminder = Reminder::findOrFail($id);
        $reminder->update(Input::get());
        if ($reminder->save()) {
            return redirect('admin/reminder')->with('success', '更新提示语成功！');
        }else{
            return Redirect::back()->withErrors(['error'=>'更新提示语失败！','status'=>0]);
        }
    }


}
