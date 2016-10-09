<?php

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * select返回的数组进行整数映射转换
 *
 */
function int_to_string(&$data,$map=array('status'=>array(1=>'正常',-1=>'删除',0=>'禁用',2=>'未审核',3=>'草稿'))) {
    foreach ($data as $key => &$row){
        foreach ($map as $col=>$pair){
            if(isset($row->$col) && isset($pair[$row->$col])){
                $text = $col.'_text';
                $row->$text = $pair[$row->$col];
            }
        }
    }
    return $data;
}

///**
// * 获取页面头部面包屑
// */
//function get_breadcrumb($data){
//    $breadcrumb = '<ul class="breadcrumb"><li><a href="'.url('admin/index/index').'"><i class="icon-home"></i> Home</a></li>';
//    foreach($data as $key=>$item){
//        if(($key+1) == count($data)){
//            $breadcrumb .= '<li class="active">'.$item['name'].'</li>';
//        }else{
//            $breadcrumb .= '<li><a href="'.$item['url'].'">'.$item['name'].'</a></li>';
//        }
//    }
//    $breadcrumb = '</ul>';
//    return $breadcrumb;
//}

/**
 * 分析枚举类型配置值
 * @param $string
 * @return array
 */
function parse_config_attr($string) {
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}

/**
 * 获取网站配置
 * @param $name 配置标识
 * @return mixed
 */
function C($name){
    $config = Cache::get('CONFIG_LIST');
    if(empty($config)){
        $config = \App\Models\SysConfig::get()->pluck('value', 'name');
        Cache::forever('CONFIG_LIST',$config);//永久保存
    }
    return $config[$name];
}

/**
 * 获取图片指定字段的值配置
 * @param $file_id 图片自增ID
 * @param string $filed 指定字段
 * @return string
 */
function get_cover($file_id,$filed='path'){
    if(empty($file_id)){
        return '';
    }
    $resault = \App\Models\Picture::select($filed)->find($file_id);
    return $resault->path;
}


