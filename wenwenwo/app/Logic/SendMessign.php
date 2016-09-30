<?php
/**
 * 发送短信的logic层
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/4
 * Time: 17:54
 */

namespace App\Logic;
require_once SCRIPT_ROOT . '/app/Helpers/Extend/sm/include/Client.php';
class SendMessignLogic
{
    private static $configArray = array();

    /**
     * 手机号
     * @param string $mobile
     * @param int $type 默认发送短信的类型 1： 注册时发送验证码；  2： 找回密码； 3： 发送普通验证码； 4：认证手机号； 5：验证手机号； 6：到期提醒
     * @param string $content 发送内容；
     * @return bool
     */
    public static function sendMessign($mobile = '',$type,$content = ''){
        if (!$mobile) {
            return false;
        }
        self::$configArray = config('sendmobile.SEND_MSG_PAREN');
        $obj =  new \Client(self::$configArray['URL'],  self::$configArray['SERIES'],  self::$configArray['PWD'], self::$configArray['SESSION_KEY'],false,false,false,false,2,10);
        $obj->setOutgoingEncoding("UTF-8");
        $obj->setIncomingEncoding("UTF-8");
        $statusCode = $obj->login();

        if ($statusCode!=null && $statusCode=="0")
        {
            $code = random_char();
            if ( $content ) {
                $content = '【问问我】'.str_replace('{{code}}', $code, $content);
            } else {
                $content = '【问问我】您的验证码是：'.$code.'。请不要把验证码泄露给其他人。';
            }
            $status = $obj->sendSMS(array($mobile), $content);
            if ($status == 0 && $status!=null) {
                log_result('接收人ip:'.get_client_ip().';接收电话:'.$mobile.';接收内容:'.$content);
                //$_SESSION['mobile'] = array('code' => $code, 'time' => time(), 'mobile'=>$mobile);
                /**
                 * 到时候根据情况来定做下面的信息；
                 * 1：存入数据库
                 * 2：添加日志文件
                 */
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}