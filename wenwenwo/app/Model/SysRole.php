<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SysRole extends Model
{
    //
    protected $table = 'sys_role';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    //获取所有权限组名称
    public static function getSysRoleInfo(){
        $list = parent::where(['status'=>1])->pluck('name','id')->toArray();
        return $list;
    }
}
