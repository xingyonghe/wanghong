<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SysMenu;

class SysAuthRule extends Model{

    protected $table = 'sys_auth_rule';
    public $timestamps = false;
    protected $fillable = [
        'title', 'type', 'name'
    ];

    // 定义常量
    const RULE_URL = 1;//url节点
    const RULE_MAIN = 2;//主菜单节点

    protected function updateRules(){
        //根据菜单获取最新的权限节点
        $nodes    = SysMenu::returnNodes(false);
        //获取已有的所有节点
        $rules    = $this->whereIn('type', array(1,2))->orderBy('name')->get()->toArray();
        //构建insert数据
        $data     = array();//保存需要插入和更新的新节点
        foreach ($nodes as $value){
            $temp['name']   = $value['url'];
            $temp['title']  = $value['title'];
            if($value['pid'] >0){
                $temp['type'] = self::RULE_URL;
            }else{
                $temp['type'] = self::RULE_MAIN;
            }
            $data[strtolower($temp['name'].$temp['type'])] = $temp;//去除重复项
        }

        $update = array();//保存需要更新的节点
        $ids    = array();//保存需要删除的节点的id
        foreach ($rules as $index=>$rule){
            $key = strtolower($rule['name'].$rule['type']);
            if ( isset($data[$key]) ) {//如果数据库中的规则与配置的节点匹配,说明是需要更新的节点
                $data[$key]['id'] = $rule['id'];//为需要更新的节点补充id值
                $update[] = $data[$key];
                unset($data[$key]);
                unset($rules[$index]);
                $diff[$rule['id']]=$rule;//把最新的菜单结果放入新的容器中
            }else{
                $ids[] = $rule['id'];
            }
        }
        if ( count($update) ) {
            foreach ($update as $k=>$row){
                if ( $row != $diff[$row['id']] ) {
                    $info = $this->findOrFail($row['id']);
                    $info->update($row);
                }
            }
        }
        if ( count($ids) ) {
            $this->destroy([implode(',',$ids)]);
        }
        if( count($data) ){
            foreach ($data as $value){
                $this->create($value);
            }
        }
        return true;
    }

    protected function getRules($map=array()){
        $list =  $this->where($map)->get()->toArray();
        $datas= array();
        foreach ($list as $key=>$val){
            $datas[$val['name']] = $val['id'];
        }
        return $datas;
    }


}
