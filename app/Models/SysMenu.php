<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Request;
use App\Library\Auth;

class SysMenu extends Model{
    use Auth;
    /**
     * 菜单模型
     */
    protected $table = 'sys_menu';
    public $timestamps = false;
    protected $fillable = [
        'title', 'pid', 'sort', 'url', 'hide', 'group'
    ];

    private $formatTree; //用于树型数组完成递归格式的全局变量

    /**
     * 列表查询
     * @param int $limit
     * @param array $map
     * @param array $order
     * @return mixed
     */
    protected function getLists($limit=10, $map=array() , $order=array('sort','asc')){
        $all_menu = $this->select('id','title')->get();
        $list = $this->where($map)->orderBy($order[0], $order[1])->paginate($limit);
        int_to_string($list,array('hide'=>array(1=>'隐藏',0=>'显示')));
        if($list) {
            foreach($list as &$key){
                foreach($all_menu as $val){
                    if($key->pid){
                        if($key->pid == $val->id){
                            $key->up_title = $val->title;
                        }
                    } else{
                        $key->up_title = '无';
                    }
                }
            }
            return $list;
        }
    }

    /**
     * 更新/新增数据
     * @param $request
     * @return bool
     */
    protected function updateData($request){
        $this->fill($request->all());
        if(empty($request->sort)){
            $this->sort = 0;
        }
        if(empty($request->id)){
            //新增
            $resualt = $this->save();

        }else{
            //编辑
            $info = $this->findOrFail($request->id);
            $resualt = $info->update(Input::get());

        }
        if($resualt === false){
            return false;
        }
        return $request;
    }


    /**
     * 获取所有菜单
     */
    protected function getMenus(){
        $menus = $this->get()->toArray();
        $menus = $this->toFormatTree($menus);
        $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
        return $menus;
    }

    public function toFormatTree($list,$title = 'title',$pk='id',$pid = 'pid',$root = 0){
        $list = list_to_tree($list,$pk,$pid,'_child',$root);
        $this->formatTree = array();
        $this->_toFormatTree($list,0,$title);
        return $this->formatTree;
    }


    /**
     * 将格式数组转换为树
     *
     * @param array $list
     * @param integer $level 进行递归时传递用的参数
     */

    private function _toFormatTree($list,$level=0,$title = 'title') {
        foreach($list as $key=>$val){
            $tmp_str=str_repeat("&nbsp;",$level*2);
            $tmp_str.="∟";
            $val['level'] = $level;
            $val['title_show'] =$level==0?$val[$title]."&nbsp;":$tmp_str.$val[$title]."&nbsp;";
            if(!array_key_exists('_child',$val)){
                array_push($this->formatTree,$val);
            }else{
                $tmp_ary = $val['_child'];
                unset($val['_child']);
                array_push($this->formatTree,$val);
                $this->_toFormatTree($tmp_ary,$level+1,$title); //进行下一层递归
            }
        }
        return;
    }

    /**
     * 返回后台节点数据
     * @param boolean $tree 是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     */
    protected function returnNodes($tree = true){
        static $tree_nodes = array();
        if ( $tree && !empty($tree_nodes[(int)$tree]) ) {
            return $tree_nodes[$tree];
        }
        if((int)$tree){
            $list = $this->select('id','pid','title','url','hide')->orderBy('sort', 'asc')->get()->toArray();
            $nodes = list_to_tree($list,$pk='id',$pid='pid',$child='operator',$root=0);
            foreach ($nodes as $key => $value) {
                if(!empty($value['operator'])){
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        }else{
            $nodes = $this->select('title','url','pid')->orderBy('sort','asc')->get()->toArray();
        }
        $tree_nodes[(int)$tree]   = $nodes;
        return $nodes;
    }





}
