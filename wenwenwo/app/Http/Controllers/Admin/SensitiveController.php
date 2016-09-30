<?php
/**
 * Created by PhpStorm.
 * Class: 敏感词
 * User: wym
 * Date: 2016/9/8
 * Time: 17:10
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\SenitiveSaveRequest;
use App\Model\SysSenivive;
use Log;
use Redirect;

class SensitiveController extends Controller
{

    /**
     * 敏感词列表
     */
    function index(){
        try{
            //$sendResult = [];
            $data = '';
            $file_path = app_path().'/../public/static/mgck.text';
            if (file_exists($file_path)) {
                $data = file_get_contents($file_path);
               /* $handle = fopen($file_path, 'r');
                while($line = fgets($handle, 1024)){
                    //if (count($sendResult) <=1000) {
                        $sendResult[] = $line;
                    //} else {
                    //    break;
                    //}
                }*/
            }
            //fclose($handle);
        }catch (\Exception $e) {
            Log::warning($e);
        } finally {
            return view('admin.sensitive.index',['data'=>$data]);
        }
    }

    /**
     * 保存敏感词
     * @param SenitiveSaveRequest $request
     */
    function edit(SenitiveSaveRequest $request){
        try {
            $sensitiveStr = $request->only('sensitive_name');
            (new SysSenivive())->replaceStr($sensitiveStr);
        } catch (\Exception $e) {
            Log::warning($e);
        } finally {
            return Redirect::to('admin/sensitive/index');
        }
    }
}
