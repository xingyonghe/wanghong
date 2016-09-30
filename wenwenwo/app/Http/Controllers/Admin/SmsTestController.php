<?php
/**
 * Created by PhpStorm.
 * Class: 短信测试Controller
 * User: wym
 * Date: 2016/9/8
 * Time: 17:10
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SmsTestRequest;
use App\Model\SysSmsTemplate;
use App\Model\SysTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SmsTestController extends Controller
{


    protected  static $status_conf = array();

    function __construct()
    {
        self::$status_conf =  config('status_conf.sms_status');
    }

    /**
     * 短信模板列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index(Request $request){
        $title = $request->get('title');
        $base = $request->get('base');
        $begin_time = $request->get('begin_time');
        $end_time = $request->get('end_time');
        $sysTest = DB::table('sys_sms_test')
            ->join('sys_sms_template', 'sys_sms_template.id', '=', 'sys_sms_test.sms_id');
        if ($title) {
            $sysTest = $sysTest->where('sys_sms_template.title',"like", '%'.$title.'%');
        }
        if($base !== '' && isset($base)){
            $sysTest = $sysTest->where('sys_sms_template.client_base',$base);
        }
        if($begin_time && !$end_time){
            $sysTest = $sysTest->where('sys_sms_test.create_at','>=' ,date('Y-m-d',$begin_time));
        }
        if(!$begin_time && $end_time){
            $sysTest = $sysTest->where('sys_sms_test.create_at','<=' ,date('Y-m-d',$begin_time));
        }
        if($begin_time && $end_time){
            $sysTest = $sysTest->whereBetween('sys_sms_test.create_at',[date('Y-m-d',strtotime($begin_time)),date('Y-m-d',strtotime($end_time))]);
        }
        $lists = $sysTest->select('sys_sms_test.id', 'sys_sms_test.create_at', 'sys_sms_template.title', 'sys_sms_template.content','sys_sms_template.client_base')
            ->orderBy('sys_sms_test.id','desc')
            ->paginate(15);
        return view('admin.smstest.index',['data'=>$lists,'status_conf'=>self::$status_conf,'where'=>$request->all(),'template'=>$this->getSysTemplate()]);
    }


    /**
     * 获取模板的名称
     * @return mixed
     */
    private function getSysTemplate(){
        return DB::table('sys_sms_template')->where('status', 1)->pluck('id','title');
    }

    /**
     * 发送手机验证码
     * @param SmsTestRequest $request
     */
    function send(SmsTestRequest $request){
        try{
            $template_id = intval($request->get('template_id'));
            $mobile_str = htmlspecialchars(trim($request->get('content')));
            if ((new SysTest())->send($template_id, $mobile_str)) {
                return Redirect::to('admin/smstest/index')->with('message', '发送成功');
            }
        } catch (\Exception $e){
            throw new \LogicException('发送失败');
        }
    }

    /**
     * 详情信息
     * @param Request $request
     */
    function info(Request $request){
        $param = $request->only('id');
        if (empty($param['id'])) {
            throw new \LogicException('请求参数错误');
        }
        $testTemplateInfo = SysTest::find($param['id']);
        if (empty($testTemplateInfo)) {
            throw new \LogicException('数据信息不存在');
        }
        //短信模板
        $template = SysSmsTemplate::find($testTemplateInfo['sms_id']);

        //短信发送列表
        $testResult = DB::table('sys_sms_test_mobile')->where('sms_test_id', '=', $testTemplateInfo['id'])->orderBy('id','desc')->paginate(10);
        //成功条数
        $successCount = DB::table('sys_sms_test_mobile')->where([['status', '=', '1'],['sms_test_id', '=', $testTemplateInfo['id']]])->count('*');
        //失败条数
        $errorCount = DB::table('sys_sms_test_mobile')->where([['status', '=', '2'],['sms_test_id', '=', $testTemplateInfo['id']]])->count('*');
        return view('admin.smstest.info',['info'=>$testTemplateInfo,'temp'=>$template,'status_conf'=>self::$status_conf,'test_temp'=>['list'=>$testResult,'ycount'=>$successCount,'ncount'=>$errorCount],'where'=>$param]);
    }

}
