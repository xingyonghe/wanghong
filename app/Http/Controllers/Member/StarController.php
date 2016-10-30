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
        $rules = [
            'avatar'     => 'required|image',
            'username'   => 'required',
            'platform'   => 'required',
            'room_id'    => 'required',
            'form_money' => 'required',
        ];
        $msgs = [
            'avatar.required'     => '请上传头像',
            'avatar.image'        => '头像格式不正确',
            'username.required'   => '请填写用户名',
            'platform.required'   => '请选择资源名称',
            'room_id.required'   => '请填写直播平台房间号',
            'form_money.required' => '请填写展现形式及报价',
        ];
        $validator = validator()->make(request()->all(),$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        dd(request()->all());
        $resualt = D('Article')->updateData(request()->all());
        if($resualt){
            return redirect('admin/article/index')->withSuccess($resualt['id']?'文章信息修改成功!':'文章信息添加成功!');
        }else{
            return redirect()->back()->with('error',Article::getError());
        }
    }






}
