<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model{

    //定义错误信息
    protected $error   = '';

    /**
     * 列表查询
     * @param int $limit
     * @param array $map
     * @param array $order
     * @return mixed
     */
    protected function adminLists($map = array(), $order = 'created_at', $sort = 'desc', $page = 10){
        $list = $this->where($map)->orderBy($order, $sort)->paginate($page);
        return $list;
    }

    /**
     * 更新/新增数据
     * @param $data 表单数据
     * @return bool
     */
    protected function updateData($data){
        if(empty($data['id'])){
            //新增
            $resualt = $this->create($data);
            if($resualt === false){
                $this->error = '信息新增失败';
                return false;
            }
        }else{
            //编辑
            $info = $this->find($data['id']);
            if(empty($info) || $info->update($data)===false){
                $this->error = '信息修改失败';
                return false;
            }
        }
        return $data;
    }
















    /**
     * 返回模型的错误信息
     * @return string
     */
    protected function getError(){
        return $this->error;
    }
}
