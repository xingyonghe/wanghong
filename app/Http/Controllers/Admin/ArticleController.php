<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;//公用控制器
use Response;//响应
use Illuminate\Http\Request;//请求
use App\Models\Article;
use App\Http\Requests\Admin\ArticleRequest;

class ArticleController extends CommonController{

    public function __construct(){
        $this->model = 'article';
    }
    /**
     * 列表
     */
    public function index(Request $request){
        $map = array(['status','>',0]);
        $title = $request->input('title');
        if($title){
            $map[] = ['title','like','%'.$title.'%'];
        }
        $datas = Article::adminLists($map);
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
        return view('admin.article.edit');
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
        $info = Article::find($id);
        if(empty($info)){
            return redirect()->back()->with('error','抱歉,您要查找的数据不存在！');
        }
        return view('admin.article.edit',compact('info'));
    }

    /**
     * 更新
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleRequest $request){
        $resualt = Article::updateData($request->all());
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
        $resualt = Article::where(array(['id',$id]))->update(array('status'=>-1));
        if($resualt){
            return redirect()->back()->withSuccess('删除信息成功!');
        }else{
            return redirect()->back()->with('error','删除信息失败');
        }
    }




}
