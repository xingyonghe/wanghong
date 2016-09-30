<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceCategorySaveRequest;
use App\Model\SrvServiceCategory;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use Log;
use DB;

/**
 * Class ServiceCategoryController
 * @package App\Http\Controllers\Admin
 * @author dch
 */
class ServiceCategoryController extends Controller
{

    //类目添加
    public function categoryAdd()
    {
        return view('admin.service_category.category_edit', ['lists' => $this->sortCategory(), 'parent_id' => 0]);
    }

    //类目修改
    public function categoryEdit($id)
    {
        $categoryArr = SrvServiceCategory::find($id);
        if (!empty($categoryArr)) {
            $categoryArr = $categoryArr->toArray();
        } else {
            $categoryArr['parent_id'] = 0;
        }
        return view('admin.service_category.category_edit', array_merge((array)$categoryArr, ['lists' => $this->sortCategory()]));
    }

    //类目保存
    public function categorySave(ServiceCategorySaveRequest $request)
    {
        try {

            $SrvServiceCategory = new SrvServiceCategory;
            DB::beginTransaction();
            $categoryData = $request->only('parent_id', 'category_name', 'short_name');
            $id = $request->get('id');
            $categoryInfo = $SrvServiceCategory->where('category_name', $categoryData['category_name'])
                ->orWhere('short_name', $categoryData['category_name'])->first();

            if ($categoryInfo && ($categoryInfo->id != $id)) {
                //category_name 或 short_name 重复不能保存
                return redirect()->back()->withInput()->withErrors(['other_error' => ['类目名称或英文名称 已存在']]);
            }

            if (empty($categoryData['parent_id'])) {
                $categoryData['depth'] = 1; // depth
            } else {
                $parentInfo = $SrvServiceCategory->where('id', $categoryData['parent_id'])->first();
                if (empty($parentInfo)) {
                    //父级id不存在
                    return redirect()->back()->withInput()->withErrors(['other_error' => ['父级分类不存在']]);
                }
                $categoryData['depth'] = $parentInfo['depth'] + 1;
            }

            if (empty($id)) {
                $id = $SrvServiceCategory->insertGetId($categoryData);
            } else {
                if ($id == $categoryData['parent_id']) {
                    return redirect()->back()->withInput()->withErrors(['other_error' => ['父级分类不能选自身']]);
                }
                $SrvServiceCategory->where('id', $id)->update($categoryData);
            }
            $SrvServiceCategory->updateIdTree($id);
            DB::commit();
        } catch (Exception $e) {
            Log::warning($e);
        } catch (Throwable $e) {
            Log::warning($e);
        }

        return redirect()->to('/admin/service_category/category_list');
    }

    //类目列表
    public function categoryList(Request $request)
    {
        $categoryName = $request->get('category_name');
        $shortName = $request->get('short_name');
        if ($categoryName || $shortName) {
            $categoryArr = SrvServiceCategory::where([['category_name', 'like', "%{$categoryName}%"], ['short_name', 'like', "%{$shortName}%"]])->get()->toArray();
        } else {
            $categoryArr = $this->sortCategory();
        }

        return view('admin.service_category.category_list', ['lists' => $categoryArr]);
    }

    protected function sortCategory()
    {
        $categoryArr = SrvServiceCategory::all() ?? [];
        $treeArr = $this->list2tree($categoryArr->toArray());
        return array_reverse($this->tree2list($treeArr));
    }

    protected function tree2list(array $treeArr)
    {
        static $ret = [];
        foreach ($treeArr as $info) {
            if (!empty($info['_children'])) {
                $this->tree2list($info['_children']);
            }
            unset($info['_children']);
            $ret[] = $info;
        }
        return $ret;
    }

    protected function list2tree(array $lists, $idKeyName = 'id', $parentIdKey = 'parent_id', $childNodesField = '_children', $rootKey = 0)
    {
        $indexed = array_column($lists, NULL, $idKeyName);
        $root = array();
        foreach ($indexed as $id => $row) {
            $indexed[$row[$parentIdKey]][$childNodesField][$id] = &$indexed[$id];
            if ($rootKey == $row[$parentIdKey]) {
                $root[$id] = &$indexed[$id];
            }
        }
        return $root;
    }

}
