<?php
/**
 * Created by PhpStorm.
 * User: lyr
 * Date: 2016/9/2
 * Time: 10:58
 */
/**
 * 返回可读性更好的文件尺寸
 */
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}

/**
 * 判断文件的MIME类型是否为图片
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

/**
 * Return "checked" if true
 */
function checked($value)
{
    return $value ? 'checked' : '';
}

/**
 * Return img url for headers
 */
function page_image($value = null)
{
    if (empty($value)) {
        $value = config('blog.page_image');
    }
    if (! starts_with($value, 'http') && $value[0] !== '/') {
        $value = config('blog.uploads.webpath') . '/' . $value;
    }

    return $value;
}

//返回json格式
function AjaxReturns($msg='请求错误',$status=-1,$url=''){
    return response()->json(['info' =>$msg, 'status' =>$status,'url'=>$url]);
}

//获取后台session信息
/**
 * @param $array_str  使用「点」式语法从深度嵌套数组中取回指定的值 ，如：products.desk 就是取出数组products下的desk值
 * @return mixed
 */
function getAdminSessionInfo($array_str=''){
    $admin_session_prefix = config('admin_config.SESSION_ADMIN_PREFIX');
    $sessionInfo = session($admin_session_prefix);
    if($array_str){
        $result = array_get($sessionInfo,$array_str);
    }else{
        $result = $sessionInfo;
    }
    return $result;
}


/*function testa(){
    require_once(dirname(__FILE__).'/Libs/phpQuery/phpQuery.php');
//    use phpQuery;
    phpQuery::newDocumentFile('http://www.baidu.com');
    $companies = pq('body');
    return $companies;
}*/

/**
 * 指定查询条件 支持安全过滤
 * @access public
 * @param mixed $where 条件表达式
 * @param mixed $parse 预处理参数
 * @return Model
 */
function assemble_where($where,$parse=null){
    $sql = '';
    $count = count($where);
    $i = 1;
    foreach($where as $key=>$val){
        if(is_array($val[1])){
            $val[1] = implode(',',$val[1]);
        }
        $sql .= "'".$key.' '.$val[0].' '.$val[1]."'";
        if($i < $count){
            $sql .= ' and ';
        }
        $i ++;
    }
//    print_r($sql);die;
//    print_r($where);die;
    return $sql;
}

//返回权限组状态
function get_rolelist_status_name($status = 0){
    $status_name = '';
    switch($status){
        case 0:
            $status_name = '已停用';
            break;
        case 1:
            $status_name = '使用中';
            break;
    }
    return $status_name;
}

//返回后台员工账号状态
function get_adminlist_status_name($status = 2){
    $status_name = '';
    switch($status){
        case 1:
            $status_name = '未锁定';
            break;
        case 2:
            $status_name = '已锁定';
            break;
    }
    return $status_name;
}

//反向处理数组(根据id 获取其所有父级)
function return_old_recur_n($list,$new_array = []){

    if(is_array($list)){
        foreach($list as $k=>$v){
            if(empty($v['child'])){
                $new_array[] = $v;
            }else{

                return_old_recur_n($v,$new_array);
            }


        }
        return array_values($list);
    }
}



