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

/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
}

/**
 * 获取分类信息并缓存分类
 * @param  integer $id    分类ID
 * @param  string  $field 要获取的字段名
 * @return string         分类信息
 */
function get_category($id, $field = null){
    static $list;
    /* 非法分类ID */
    if(empty($id) || !is_numeric($id)){
        return '';
    }

    /* 读取缓存数据 */
    if(empty($list)){
        $list = Cache::get('CATEGORY_LIST');
    }

    /* 获取分类名称 */
    if(!isset($list[$id])){
        $cate = \App\Models\Category::find($id);
        if(empty($cate)){ //不存在分类，或分类被禁用
            return '';
        }
        $list[$id] = $cate;
        Cache::forever('CATEGORY_LIST',$list);//更新缓存
    }
    return is_null($field) ? $list[$id] : $list[$id][$field];
}

/* 根据ID获取分类标识 */
function get_category_name($id){
    return get_category($id, 'name');
}

/**
 * 实例化模型类
 * @return Model
 */
function D($name='') {
    static $_model = array();
    if(isset($_model[$name])){
        return $_model[$name];
    }

    if(empty($name)){
        $class = '\\App\Models\\CommonModel';
    }else{
        $class = '\\App\Models\\'.$name;
        if(!class_exists($class)) {
            throw new InvalidArgumentException('D方法实例化没找到模型类'.$class);
        }
    }
    $model = new $class();
    $_model[$name]  =  $model;
    return $model;
}



