<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\PubSeoRule;
use App\Http\Requests\Admin\SeoRuleSaveRequest;
use Exception;
use Log;
/**
 * 后台SEO配置管理
 *
 * Class SeoController
 * @package App\Http\Controllers\Admin
 * @author dch
 */
class SeoController extends Controller
{
    //SEO 规则列表
    public function ruleList()
    {
        return view('admin.seo.rule_list',['lists'=>PubSeoRule::all()]);
    }

    //SEO 规则添加
    public function ruleAdd()
    {
        return view('admin.seo.rule_edit');
    }

    //SEO 规则修改
    public function ruleEdit($id)
    {
        $ruleData = PubSeoRule::find($id);

        return view('admin.seo.rule_edit',$ruleData ?? []);
    }

    //SEO 规则保存
    public function ruleSave(SeoRuleSaveRequest $request)
    {
        try {
            $PubSeoRule = new PubSeoRule;
            $ruleData = $request->only('call_key', 'page_name', 'title', 'keywords', 'description');
            if ($id = $request->get('id')) {
                $PubSeoRule->where('id', $id)->update($ruleData);
            } else {
                $PubSeoRule->fill($ruleData)->save();
            }
        } catch (Exception $e) {
            Log::error($e);
        }

        return redirect()->to('admin/seo/rule_list');
    }

}
