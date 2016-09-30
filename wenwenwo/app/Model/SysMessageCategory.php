<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class SysMessageCategory extends Model{
    protected $table = 'sys_message_category';
    public $timestamps = false;
    protected $fillable = ['name'];

    protected function uodateData($request){
        $this->fill($request->all());//fill是根据$fillable进行字段过滤的，防止非法字段提交
        if(empty($request->id)){
            //新增
            $result = $this->save();
        }else{
            //更新
            $params = $this->findOrFail($request->id);
            $result = $params->update(Input::get());
        }
        if($result === false){
            return false;
        }
        return $request;

    }

    /**
     * 获取所有分类
     * 返回id为键name为值得数组
     * @return mixed
     */
    protected function getMessageCategory(){
        $datas = $this->orderBy('id','asc')->pluck('name', 'id')->toArray();
        return $datas;
    }

    /**
     * 获取列表
     * @return mixed
     */
    protected function getList(){
        $datas = $this->orderBy('id','asc')->paginate(10);
        return $datas;
    }
}
