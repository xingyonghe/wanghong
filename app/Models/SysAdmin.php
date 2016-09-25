<?php

namespace App\Models;

use App\Models\SysAuthGroup;
use Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SysAdmin extends Authenticatable{
    
    use Notifiable;

    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'sys_admin';
    protected $dateFormat = 'U';
    protected $fillable = [
        'username', 'password','reg_time','login_time','login_ip','role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    protected function getLists($limit=10, $map=array() , $order=array('reg_time','desc')){
        $list = $this->where($map)->orderBy($order[0], $order[1])->paginate($limit);
        $groups = SysAuthGroup::where('status','=',1)->get()->toArray();
        foreach ($groups as $val){
            $roletext[$val['id']] = $val['title'];
        }
        int_to_string($list,array(
            'status' => array(1=>'<span class="label label-success">正常</span>',0=>'<span class="label label-danger">禁用</span>'),
            'role_id' => $roletext
        ));
        return $list;
    }

    /**
     * 更新/新增数据
     * @param $request
     * @return bool
     */
    protected function updateData($request){
        $this->fill($request->all());
        $this->password = bcrypt($request->password);
        $this->reg_time = date('Y-m-d H:i:s');
        $resualt = $this->save();
        if($resualt === false){
            return false;
        }
        return $request;
    }
}
