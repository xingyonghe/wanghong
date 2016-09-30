<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Params extends Model{

    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'sys_param';
    protected $fillable = ['type','cate','shape','title','name','content','note','alt'];
//    //序列化的字段
//    protected $casts = [
//        'content' => 'array',
//    ];

//    /**
//     * Content字段保存数据自动完成
//     * @param $value
//     */
//    protected function setContentAttribute($value){
//        $this->attributes['content'] = $this->getContent($value);
//    }
//
//    /**
//     * 处理参数值
//     * @param $data
//     */
//    protected function getContent($data){
//        $lists = explode(',',str_replace(array("\r\n","\n","\r"),',',$data));
//        foreach ($lists as $key => $value) {
//            $lists[$key] = explode('|', $value);
//        }
//        return json_encode($lists);
//    }


    /**
     * 参数控件自动替换
     * @param $value
     */
    protected function getShape($data){
        $shapeArray = array('1' => '单选', '2' => '多选', '3' => '下拉框');
        return $shapeArray[$data];
    }
   
    /**
     * 获取所有提示语列表
     * @return mixed
     */
    protected function list($limit = 10,$where=array(),$order = array('id','desc')){

        $datas = $this->where($where)
            ->orderBy($order[0],$order[1])
            ->paginate($limit);

        foreach($datas as $keky=>&$val){
            $val['shape'] = $this->getShape($val['shape']);
        }
        return $datas;
    }
}
