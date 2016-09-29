<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class SysChannel extends Model{

    protected $table = 'sys_channel';
    protected $fillable = [
        'title', 'remark','url','sort','status','target'
    ];

    /**
     * 列表查询
     * @param int $limit
     * @param array $map
     * @param array $order
     * @return mixed
     */
    protected function getLists($map){
        $list = $this->where($map)->orderBy('sort', 'asc')->get()->all();
        int_to_string($list,array('status'=>array(0=>'隐藏',1=>'显示'),'target'=>array(0=>'否',1=>'是')));
        return $list;
    }

    /**
     * 更新/新增数据
     * @param $request
     * @return bool
     */
    protected function updateData($request){
        $this->fill($request->all());
        if(empty($request->sort)){
            $this->sort = 0;
        }
        if(empty($request->id)){
            //新增
            $resualt = $this->save();

        }else{
            //编辑
            $info = $this->findOrFail($request->id);
            $resualt = $info->update(Input::get());

        }
        if($resualt === false){
            return false;
        }
        return $request;
    }


}
