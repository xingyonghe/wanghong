<?php
/**
 * Class 短信Model
 * @method
 * @package App
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SysTest extends Model
{
    protected $table = 'sys_sms_test';

    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $guarded = ['id'];

    /**
     * 新增发送测试数据
     * @param array $newData
     * @return bool
     */
    public function insert(array $newData)
    {
        if (empty($newData)) {
            throw new \LogicException("参数不能为空");
        }
        return  $this::insertGetId($newData);
    }

    /**
     * 发送手机号码
     * @param $template_id 短信模板
     * @param $content 手机号码
     * @return bool
     */
    function  send ($template_id, $mobile_str) {
        $mobileArray = explode(',', $mobile_str);
        if (empty($template_id) || !is_array($mobileArray)) {
            return false;
        }
        $find = SysSmsTemplate::find($template_id);
        if (empty($find)) {
            return false;
        }
        //先新增记录在发送短信信息；
        $testId = $this->insert(array('sms_id'=>$template_id));
        if (empty($testId)) {
            return false;
        }
        //目前仅支持普通的验证发送，其他短信需要根据需求来修修改；
        return $this->sendMobile($testId, $find['content'], array_unique(array_unique($mobileArray)));
    }

    /**
     * 发送方法
     * @param $testId id
     * @param $content 内容
     * @param $mobileArr 手机数组
     * @return bool
     */
    function sendMobile ($testId, $content, $mobileArr) {
        $sysTestData = [];
        $sysTestData['sms_test_id'] = $testId;
        $newSysTestData = [];
        foreach ($mobileArr as $v) {
            $sysTestData['mobile'] = '"'.$v. '"';
            $sysTestData['status'] = 2;
            if (validate($v, 'm')) {
                if (send_messign($v, $content)) {
                    $sysTestData['status'] = 1;
                }
            }
            $newSysTestData[] = $sysTestData;
        }
        DB::table('sys_sms_test_mobile')->insert($newSysTestData);
        return true;
    }
}
