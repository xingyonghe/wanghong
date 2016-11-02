<?php

namespace App\Models;

class Media extends CommonModel{
    const STATUS_DELETE = -1;//删除
    const STATUS_LOCKED = 0;//锁定
    const STATUS_CREATE = 1;//正常
    const STATUS_VERIFY = 2;//待审核
    const STATUS_FAILED = 3;//审核未通过
    //模型表名称
    protected $table = 'media';
    //白名单
    protected $fillable = [
        'username','userid', 'avatar','type', 'platform', 'form_money', 'homepage','room_id','manner','fan','online','status'
    ];
    //黑名单
    protected $guarded = [
        'id','created_at', 'updated_at','bespeak','accept','refuse','level'
    ];
    

    /**
     * 更新/新增数据
     * @param $data 表单数据
     * @return
     */
    public function updateData($data){
        if(empty($data['id'])){
            //新增初始化赋值
            $data['userid'] = auth()->id();
            $data['status'] = self::STATUS_CREATE;//正常
            if(C('USER_MEDIA_VERIFY')){
                $data['status'] = self::STATUS_VERIFY;//需要审核
            }
            //新增
            $resualt = $this->create($data);
            if($resualt === false){
                $this->error = '媒体信息新增失败';
                return false;
            }
        }else{
            //编辑
            $info = $this->where('userid',auth()->id())->whereIn('status',[self::STATUS_CREATE,self::STATUS_FAILED])->find($data['id']);
            //修改审核未通过的变成待审核
            if($info['status'] == self::STATUS_FAILED){
                $data['status'] = self::STATUS_VERIFY;//需要审核
            }
            if(empty($info) || $info->update($data)===false){
                $this->error = '媒体信息修改失败';
                return false;
            }
        }
        return $data;
    }

}
