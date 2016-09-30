<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model{
    protected $table = 'sys_variable';
    protected $fillable = ['name','variable','confines'];

    /**
     * 获取所有提示语列表
     * @return mixed
     */
    protected function list($limit = 10, $where=array(), $order = array('created_at','desc')){
        $datas = $this->where($where)->orderBy($order[0],$order[1])->paginate($limit);
        return $datas;
    }
}
