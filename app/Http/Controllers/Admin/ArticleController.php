<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use URL;
use App\Models\Article;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller{
    /**
     * 列表
     */
    public function index(){
        $map = array(['status','>',0]);
        $title = Input::get('title') ?? '';
        if(!empty($title)){
            $map[] = ['title',$title];
        }
        $datas = Article::getAdminLists($map);
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
    public function update(Request $request){
        $resualt = Article::updateData($request);
        if($resualt){
            return redirect('admin/article/index')->withSuccess($resualt->id?'文章信息修改成功!':'文章信息添加成功!');
        }else{
            return redirect()->back()->with('error',$resualt->id?'文章信息修改失败!':'文章信息添加失败!');
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
