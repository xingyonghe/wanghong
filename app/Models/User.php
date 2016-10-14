<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Request;
use DB;
use App\Models\UserPersonal;

class User extends Model{
    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'user';
    protected $dateFormat = 'U';
    protected $fillable = [
        'username','nickname','qq','weixin','email','password','type'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 后台用户列表
     * @return mixed
     */
    protected function getAdminLists($map){
        $list = $this->where($map)
            ->whereIn('status',['0','1'])
            ->leftJoin('user_personal', 'user.id', '=', 'user_personal.user_id')
            ->orderBy('reg_time','desc')
            ->paginate(10);

        int_to_string($list,array(
            'status' => array(
                0=>'<span class="label label-info">锁定</span>',
                1=>'<span class="label label-success">正常</span>',
            ),
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
        if(empty($request->id)){
            //新增
            $this->password = bcrypt($request->password);
            $this->is_auth = 0;//手机账户未认证
            $this->status = 1;//后台添加的账户不用审核
            $this->reg_time = date('Y-m-d H:i:s');
            $this->reg_ip = $request->ip();
            DB::beginTransaction();
            if($this->save() && UserPersonal::create(array('user_id'=>$this->id))){
                $resualt = true;
                DB::commit();//如果处理成功,通过 commit 的方法提交事务
            }else{
                $resualt = false;
                DB::rollback();//如果处理失败,通过 rollback 的方法回滚事务
            }

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


    /**
     * 重置密码
     */
    protected function resetPassword($request){
        $resualt = $this->where(array(['username','=',$request->username]))->update(array('password'=>bcrypt($request->password)));
        if($resualt === false){
            return false;
        }
        return $request;
    }

}
