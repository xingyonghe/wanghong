<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class SysConfig extends Model{

    protected $table = 'sys_config';
    protected $fillable = [
        'title', 'name','sort','type','group','value','extra','remark'
    ];

    /**
     * 列表查询
     */
    protected function getLists($map = array()){
        $list = $this->where($map)->orderBy('created_at', 'desc')->paginate(10);
        int_to_string($list,array('group'=>array(0=>'基本设置',1=>'SEO优化'),
            'type'=>array(0=>'数字',1=>'字符',2=>'文本',3=>'数组',4=>'枚举',5=>'图片')));
        return $list;
    }

    /**
     * 更新/新增数据
     * @param $request
     * @return bool
     */
    protected function updateData($request){
        $this->fill($request->all());
        if(empty($this->sort)){
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
