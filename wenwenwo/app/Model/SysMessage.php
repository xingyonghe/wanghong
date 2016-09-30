<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Input;
use App\Model\SysMessageCategory;

class SysMessage extends Model{
    protected $table = 'sys_message';//指定数据表
    public $timestamps = false;//不需要增加修改时间
    protected $dateFormat = 'U';//设置时间格式
    protected $fillable = ['title','content','send_time','user_id','message_catid'];//设置允许设置的字段

    /**
     * 更新/新增操作
     * @param $request
     * @return $this
     */
    protected function updateData($data){
        $this->fill($data);//fill是根据$fillable进行字段过滤的，防止非法字段提交
        $this->send_time = date('Y-m-d H:i:s',time());
        $this->save();
    }

    /**
     * 获取列表
     * @return mixed
     */
    protected function getList(){
        $datas = $this->orderBy('send_time','desc')->paginate(10);
        $category = SysMessageCategory::getMessageCategory();
        $statusText = array('0'=>'未读','1'=>'已读','99'=>'删除');
        foreach($datas as $key=>&$val){
            $val->category = $category[$val->message_catid];
            $val->statusText = $statusText[$val->status];
        }
        return $datas;
    }
}
