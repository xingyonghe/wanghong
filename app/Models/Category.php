<?php

namespace App\Models;

class Category extends CommonModel{
    protected $table = 'category';
    protected $fillable = [
        'name','sort', 'pid', 'model',
    ];
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * 获取所有分类
     * @param array $map
     * @return mixed
     */
    public function getCategory($map = array()){
        $lists = $this->select('id','name','pid')->where($map)->orderBy('sort','asc')->get()->toArray();
        return $lists;
    }

    /**
     * 分类更新下拉菜单
     * @param $model
     * @return array|mixed
     */
    public function getMenu($model){
        $lists = $this->getCategory(array(['model',$model]));
        $menus = $this->toFormatTree($lists,'name');
        $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级分类')), $menus);
        return $menus;
    }

    /**
     * 信息发布下拉菜单
     * @param $model
     * @return array|mixed
     */
    public function getTree($model){
        $lists = $this->getCategory(array(['model',$model]));
        $menus = $this->toFormatTree($lists,'name');
        $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'请选择')), $menus);
        return $menus;
    }
























}
