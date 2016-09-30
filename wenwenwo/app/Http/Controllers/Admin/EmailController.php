<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Support\Facades\Input;
use Validator;
class EmailController extends Controller{

    public function index(){
        return view('admin.email.testemail');
    }

    /**
     * 测试发送邮件
     */
    public function send(Request $request){
        $toname = Input::get('name');
        $content = Input::get('content');
        $rules = [
            'name'       => 'required',
            'content'    => 'required',
        ];
        $msg =  [
            'name.required'    => '请填写测试账号',
            'content.required'    => '请填写测试内容',
        ];
        Validator::make($request->all(), $rules, $msg)->validate();

        $messages = array('raw' => $content);
        $toname = explode(';',$toname);
        //单个发送
//        Mail::send($messages, $data, function ($message) use($data){
//            $message ->to($data['email'])->subject('这是一封测试邮件');
//        });
        //队列发送
        foreach($toname as $name){
            $data = array('email'=>$name);
            Mail::queueOn('queue-name', $messages, $data, function ($message) use($data){
                $message ->to($data['email'])->subject('这是一封测试邮件');
            });
        }

        return redirect('admin/email')->with('success', '测试邮件发送成功！');
    }
}
