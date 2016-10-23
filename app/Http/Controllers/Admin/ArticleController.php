<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Controllers\CommonController;//公用控制器

class ArticleController extends CommonController{

    protected $model = '';//分类模块分组

    public function __construct(){
        $this->model = 'article';
    }

    /**
     * 列表
     */
    public function index(){
        $map = array(['status','>',0]);
        $title = request()->input('title');
        if($title){
            $map[] = ['title','like','%'.$title.'%'];
        }
        $datas = D('Article')->adminLists($map);
        int_to_string($datas,array(
            'status' => array(
                0=>'<span class="label label-info">锁定</span>',
                1=>'<span class="label label-success">正常</span>',
            ),
        ));
        $pages = array(
            'title' => $title
        );
        return view('admin.article.index',compact('datas','pages'));
    }

    /**
     * 新增
     * @return mixed
     */
    public function add(){
        $trees = D('Category')->getTree($this->model);
        return view('admin.article.edit',compact('trees'));
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){
        if(empty($id) ||!is_numeric($id)){
            return redirect()->back()->with('error','参数错误！');
        }
        $info = D('Article')->find($id);
        if(empty($info)){
            return redirect()->back()->with('error','抱歉,您要查找的数据不存在！');
        }
        $trees = D('Category')->getTree($this->model);
        return view('admin.article.edit',compact('info','trees'));
    }

    /**
     * 更新
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleRequest $request){
        $resualt = D('Article')->updateData($request->all());
        if($resualt){
            return redirect('admin/article/index')->withSuccess($resualt['id']?'文章信息修改成功!':'文章信息添加成功!');
        }else{
            return redirect()->back()->with('error',Article::getError());
        }
    }


    /**
     * 删除，状态变为-1
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        if(empty($id) ||!is_numeric($id)){
            return redirect()->back()->with('error','参数错误！');
        }
        $resualt = D('Article')->where(array(['id',$id]))->update(array('status'=>-1));
        if($resualt){
            return redirect()->back()->withSuccess('删除信息成功!');
        }else{
            return redirect()->back()->with('error','删除信息失败');
        }
    }




}
