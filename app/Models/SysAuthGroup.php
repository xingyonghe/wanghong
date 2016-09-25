<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Request;

class SysAuthGroup extends Model{

    protected $table = 'sys_auth_group';
    public $timestamps = false;
    protected $fillable = [
        'title', 'description', 'status', 'rules'
    ];
    protected $casts = [
        'rules' => 'array',
    ];

    /**
     * 列表查询
     * @param int $limit
     * @param array $map
     * @param array $order
     * @return mixed
     */
    protected function getLists($limit=10,$order=array('id','desc')){
        $list = $this->orderBy($order[0], $order[1])->paginate($limit);
        int_to_string($list,array('status'=>array(1=>'<span class="label label-success">正常</span>',0=>'<span class="label label-danger">禁用</span>')));
        return $list;
    }

    /**
     * 更新/新增数据
     * @param $request
     * @return bool
     */
    protected function updateData($request){
        $this->fill($request->all());
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
