<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SysPosition extends Model
{
    //
    protected $table = 'sys_position';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    //获取所有职位名称
    public static function getSysPositionInfo(){
        $list = parent::where(['status'=>1])->pluck('name','id')->toArray();
        return $list;
    }
}
