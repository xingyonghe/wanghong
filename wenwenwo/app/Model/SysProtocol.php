<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
class SysProtocol extends Model{
    /**
     * 协议模型
     * @author xingyonghe
     * @date 2016.9.22
     */

    protected $table = 'sys_protocol';
    protected $fillable = ['title', 'content'];
    protected $guarded = ['name'];


    /**
     * 更新/新增操作
     * @param $request
     * @return $this
     */
    protected function updateData($request){
        $this->fill($request->all());//fill是根据$fillable进行字段过滤的，防止非法字段提交
        $this->name = session('admin_result.name');
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
     * 获取列表
     * @return mixed
     */
    protected function getList($limit=10,$where=array(),$order=array('created_at','desc')){
        $datas = $this->where($where)->orderBy($order[0],$order[1])->paginate($limit);
        return $datas;
    }
}
