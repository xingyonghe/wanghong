<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Article extends Model{

    protected $table = 'article';
    protected $fillable = [
        'title', 'descrition', 'view', 'author', 'quote', 'content'
    ];

    /**
     * 列表查询
     * @param int $limit
     * @param array $map
     * @param array $order
     * @return mixed
     */
    protected function getAdminLists($map){
        $list = $this->where($map)->orderBy('created_at', 'desc')->paginate(10);;
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
            if(empty($this->descrition)){
                $this->descrition = msubstr(strip_tags($this->content),0,150);
            }
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
