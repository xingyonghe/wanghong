<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\CommonController;

class StarController extends CommonController{

    public function __construct(){
        view()->share('nav',5);//设置导航高亮
        //新增/编辑共享直播平台数据
        view()->composer(['user.star.edit','user.star.add'],function($view){
            $view->with('mediaType',parse_config_attr(C('USER_MEDIA_TYPE')));
        });

    }

    /**
     * 网红列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $lists = D('Media')->listing(array(['userid',auth()->id()]));
        dd($lists);
        return view('user.star.index');
    }

    /**
     * 网红修改
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(){
        return view('user.star.edit');
    }

    /**
     * 网红修改
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(){
        return view('user.star.edit');
    }

    /**
     * 网红列表更新
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(){
        $data = request()->all();
        if(empty($data['platform'])){
            $data['platform'] = $data['platform_select'];
        }
        unset($data['platform_select']);
        $rules = [
            'avatar'     => 'required',
            'username'   => 'required',
            'type'       => 'required',
            'platform'   => 'required',
            'room_id'    => 'required',
            'homepage'   => 'required',
            'form_money' => 'required',
        ];
        $msgs = [
            'avatar.required'     => '请上传头像',
            'avatar.image'        => '头像格式不正确',
            'username.required'   => '请填写用户名',
            'type.required'       => '请选择资源类别',
            'platform.required'   => '请选择直播平台',
            'room_id.required'    => '请填写直播平台房间号',
            'homepage.required'   => '请填写直播平台ID',
            'form_money.required' => '请填写展现形式及报价',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $data['userid'] = auth()->id();
        $data['status'] = 1;//正常
        if(C('USER_MEDIA_VERIFY')){
            $data['status'] = 2;//需要审核
        }
        $resualt = D('Media')->updateData($data);
        if($resualt){
            return $this->ajaxReturn(isset($resualt['id'])?'网红信息修改成功!':'网红信息添加成功!',1,route('user.star.index'));
        }else{
            return $this->ajaxReturn(D('Media')->getError());
        }
    }






}
