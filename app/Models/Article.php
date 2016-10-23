<?php

namespace App\Models;

class Article extends CommonModel{

    protected $table = 'article';
    protected $fillable = [
        'title','catid', 'descrition', 'author', 'quote', 'content'
    ];
    protected $guarded = [
        'id', 'view', 'status', 'created_at', 'updated_at'
    ];

    /**
     * 更新/新增数据
     * @param $data 表单数据
     * @return bool
     */
    public function updateData($data){
        if(empty($data['descrition'])){
            $data['descrition'] = msubstr(strip_tags($data['content']),0,150);
        }
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


}
