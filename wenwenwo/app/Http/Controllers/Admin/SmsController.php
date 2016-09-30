<?php
/**
 * Created by PhpStorm.
 * Class: 短信Controller
 * User: wym
 * Date: 2016/9/8
 * Time: 17:10
 */
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SmsTemplateRequest;
use App\Http\Controllers\Controller;
use App\Model\SysSmsTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use League\Flysystem\Exception;

class SmsController extends Controller
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
        $status = $request->get('status');
        $base = $request->get('base');
        $begin_time = $request->get('begin_time');
        $end_time = $request->get('end_time');
        $SysSmsTemplate = new SysSmsTemplate;
        if ($title) {
            $SysSmsTemplate = $SysSmsTemplate->where('title',"like", '%'.$title.'%');
        }
        if($status){
            $SysSmsTemplate = $SysSmsTemplate->where('status',$status);
        }
        if($base !== '' && isset($base)){
            $SysSmsTemplate = $SysSmsTemplate->where('client_base',$base);
        }
        if($begin_time && !$end_time){
            $SysSmsTemplate = $SysSmsTemplate->where('create_at','>=' ,date('Y-m-d',$begin_time));
        }
        if(!$begin_time && $end_time){
            $SysSmsTemplate = $SysSmsTemplate->where('create_at','<=' ,date('Y-m-d',$begin_time));
        }
        if($begin_time && $end_time){
            $SysSmsTemplate = $SysSmsTemplate->whereBetween('create_at',[date('Y-m-d',strtotime($begin_time)),date('Y-m-d',strtotime($end_time))]);
        }
        $lists = $SysSmsTemplate->orderBy('id','desc')->paginate(15);
        return view('admin.smstemplate.index',['data'=>$lists,'status_conf'=>self::$status_conf,'where'=>$request->all()]);
    }

    /**
     * 添加修改页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function edit(Request $request){
        $id = intval($request->get('id'));
        $info = [];
        if (!empty($id) && $id > 0) {
            $info = SysSmsTemplate::where('id', $id)->first();
        }
        return view('admin.smstemplate.edit', ['statuc_conf'=>self::$status_conf,'info'=>$info]);
    }


    /**
     * 添加或者修改
     * @param SmsTemplateRequest $request
     * @return mixed
     */
    function save(SmsTemplateRequest $request){
        try {
            $checkResult = $request->only('title', 'content', 'status' ,'remark', 'typeid','client_base');
            $checkResult['typeid'] = implode(',', $checkResult['typeid']);
            (new SysSmsTemplate())->insert($checkResult, $request->get('id'));
        } catch (\Exception $e) {
            Log::warning($e);
        } catch (\Throwable $e) {
            Log::warning($e);
        } finally {
            return Redirect::to('admin/sms/index');
        }
    }


    /**
     * 删除信息
     * @param Request $request
     */
    function del(Request $request){
        $id = intval($request->get('ids'));
        if (empty($id) || $id <= 0) {
            return_ajax(); die;
        }
        try {
            (new SysSmsTemplate())->del($id);
        } catch (\Exception $e) {
            return_ajax('0','删除失败');die;
        }
        return_ajax('200','删除成功');die;
    }

}
