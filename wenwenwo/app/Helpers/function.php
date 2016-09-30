<?php
/**
 * 发送短信码
 * @param $mobile 手机号
 * @param $content 发送内容； 可以为默认普通验证短信； 如果要手动传入发送内容列入： “您再平台认证的店铺，你的手机验证码是{{code}}，请不要告诉他人”；  {{code}}, 替换发送验证码
 * @return bool
 */
function send_messign($mobile, $content = '')
{
    if (empty($mobile)) {
        return false;
    }
    require_once  __DIR__."/../Logic/SendMessign.php";
    return \App\Logic\SendMessignLogic::sendMessign($mobile, 1 , $content);
}



/**
 * 注册时所用到的注册码
 * @return string
 */
function random_char()
{
    $char = '0123456789';
    $mak = '';
    for ($i = 0; $i < 6; $i++) {
        $mak .= $char[mt_rand(0, strlen($char) - 1)];
    }
    return $mak;
}



/**
 * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
 * 注意：服务器需要开通fopen配置
 * @param $word 要写入日志里的文本内容 默认值：空值
 */
function log_result($word = '', $file_name = 'log', $suffix = '.txt', $path = '../Log/SendMobile/')
{
    $fp = fopen($path.$file_name . $suffix, "a");
    flock($fp, LOCK_EX);
    fwrite($fp, "执行日期：" . date('Y-m-d H:i:s',time()) . "\n文件内容：" . $word . "\n\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}



/**
 *敏感词集合
 * @param string $subject 需要过滤的对象
 * @param string $replace 替换对象 文字或者是样式
 * @param boole $isCount 是否返回替换次数
 * @return array || string
 */
function ensitive_word_filtering($subject, $replace = '***', $isCount = false)
{
    $search = array();
    $file_path = "./static/mgck.text"; //要打开的文件的相对路径或者绝对路径
    if (file_exists($file_path)) {    //判断要打开的txt文件是否存在
        $handle = fopen($file_path, 'r');
        while (!feof($handle)) {
            $temp = str_replace('={MOD}', '', fgets($handle));
            $search[] = trim($temp);
        }
        fclose($handle);
    }
    if (empty($search)) {
        return $subject;
    }
    if ($isCount === true) {
        if ($replace == '***') {
            $subject = str_replace($search, $replace, $subject, $i);
        } else {
            foreach ($search as $k=>$v) {
                if(stripos($subject, $v) !== false ){
                    $subject = str_replace($v, "<label style='color: ".$replace.";fond-size:600'>{$v}</label>", $subject);
                }
            }
            $subject = htmlspecialchars_decode($subject);
        }
        return array('count' => $i, 'subject' => $subject);
    } else {
        if ($replace == '***') {
            return str_replace($search, $replace, $subject);
        }
        foreach ($search as $k=>$v) {
            if(stripos($subject, $v) !== false ){
                $subject = str_replace($v, "&lt;label style='color: ".$replace.";fond-size:600' &gt;{$v}&lt;/label &gt;", $subject);
            }
        }
        return htmlspecialchars_decode($subject);
    }
}



/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**
 * 获取单个提示语信息
 * @param $id 提示语ID
 * @return mixed
 */
function get_reminder($name){
    $info = \App\Model\Reminder::where('name',$name)->first();
    return $info->content;
}

/**
 * 获取参数
 * @param $name 参数标识
 * @return mixed
 */
function get_params($name='',$field='',$default=0,$params=array()){
    $info = \App\Model\Params::where('name',$name)->first();
    $params['title'] = $info->alt;
    $lists = explode(',',str_replace(array("\r\n","\n","\r"),',',$info->content));
    foreach($lists as $key => $value){
        $lists[$key] = explode('-',$value);
    }
    //重组数组
    $arr = array();
    foreach($lists as $key => $value){
        $arr[$value[0]] = $value[1];
    }
    $html = '';
    switch($info->shape){
        case '1':
            //单选
            $html .= Form::radios($field,$arr,$default,$params);
            break;
        case '2':
            //多选
            $html .= Form::checkboxs($field,$arr,$default,$params);
            break;
        case '3':
            //下拉框
            $html .= Form::select($field,$arr,$default,$params);
            break;
    }
    return $html;
}
/*
 * 输入json数据
 * @param int $status
 * @param string $msg
 * @param string $url
 * @param string $id
 */
function return_ajax($status = 0, $msg = '请求异常', $url = '', $id = ''){
    echo json_encode(['status'=>$status, 'info'=>$msg, 'url'=>$url, 'id'=>$id]);
}


/**
 * 统一验证
 * @param $str 字符串
 * @param $t 类型
 * @return bool|int
 */
function validate($str , $t){
    static $validateArray = array(
        'e' => '/^[\w\d]+[\w\d-.]*@[\w\d-.]+\.[\w\d]{2,10}$/',//email 邮箱
        'm' => '/^1[356879]{1}[0-9]{9}$/',//mobile 手机
        't' => '/^0[0-9]{2,3}[-]?\d{7,8}$/',//telphone 座机
        'tel' => '/^(?:(?:0\d{2,3})-)?(?:\d{7,8})(-(?:\d{3,}))?$/',//telphone 座机
        'p' => '/^\d{6}$/',//post 邮编
        'card' => '/^([1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3})|(/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|x|X)$/)$/',//post 身份证
        'user' => '/^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){5,18}$/',//用户名
        'pass' => '/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{6,16}$/',//密码
    );
    if (!array_key_exists($t, $validateArray)) return false;
    return preg_match($validateArray[$t], $str);
}

/**
 * 发送消息
 * @param $userid 用户ID
 * @param $title 标题
 * @param $content 内容
 * @param $category 分类
 */
function send_esssage($userid,$title,$content,$category){
    $array = array(
        'user_id' => $userid,
        'title' => $title,
        'content' => $content,
        'message_catid' => $category,
    );
    \App\Model\SysMessage::updateData($array);
}

