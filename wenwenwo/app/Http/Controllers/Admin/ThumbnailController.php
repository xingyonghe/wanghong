<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ThumbnailRuleRequest;
use App\Model\SysSetting;
use App\Model\SysThumbnailRule;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ThumbnailConfigRequest;
use Log;
use DB;

/**
 * 后台缩略图生成规则配置
 *
 * Class ThumbnailController
 * @package App\Http\Controllers\Admin
 * @author dch
 */
class ThumbnailController extends Controller
{
    const SETTING_THUMBNAIL_NAME = 'thumbnail_config';
    protected $rules = [1 => '依据最长边', 2 => '高度', 3 => '宽度']; // 生成规则
    protected $types = [1 => '店铺头像', 2 => '服务信息', 4 => '案例信息']; // 分类

    protected $fpLock;

    // 规则列表
    public function ruleList(Request $request)
    {
        $ruleFields = $request->only('name', 'height', 'width', 'types');
        $SysThumbnailRule = new SysThumbnailRule;
        $condition = [];
        $condition[] = ['name', 'like', "%{$ruleFields['name']}%"];
        if ($ruleFields['height']) {
            $condition[] = ['height', intval($ruleFields['height'])];
        }
        if ($ruleFields['width']) {
            $condition[] = ['width', intval($ruleFields['width'])];
        }
        if(is_array($ruleFields['types'])){
            $ruleFields['types'] = array_filter($ruleFields['types'],function ($value){return '' !== $value;});
            $ruleFields['types'] = array_intersect_key($ruleFields['types'],$this->types);
            foreach($ruleFields['types'] as $type => $checked){
                if($checked){
                    $condition[] = ['scope','&',$type];
                }else{
                    $condition[] = [DB::raw('~`scope`'),'&', $type];
                }
            }
        }
        $lists = $SysThumbnailRule->where($condition)->get();

        return view('admin.thumbnail.rule_list', array_merge($ruleFields, ['lists' => $lists, 'types' => $this->types,'selectedTypes'=>$ruleFields['types']]));
    }

    // 规则添加
    public function ruleAdd()
    {
        return view('admin.thumbnail.rule_edit', ['types' => $this->types]);
    }

    // 规则编辑
    public function ruleEdit($id)
    {
        $thumbnailRuleData = SysThumbnailRule::find($id);

        return view('admin.thumbnail.rule_edit', array_merge($thumbnailRuleData->toArray(), ['types' => $this->types]));
    }

    // 规则保存
    public function ruleSave(ThumbnailRuleRequest $request)
    {
        $thumbnailRuleData = $request->only('name', 'width', 'height');
        $thumbnailRuleData['scope'] = 0;
        $types = array_intersect((array)$request->get('types'), array_keys($this->types));
        foreach ($types as $type) {
            $thumbnailRuleData['scope'] |= intval($type);
        }
        $id = intval($request->get('id'));
        $SysThumbnailRule = new SysThumbnailRule;
        if ($id) {
            $SysThumbnailRule->where('id', $id)->update($thumbnailRuleData);
        } else {
            $SysThumbnailRule->fill($thumbnailRuleData);
            $SysThumbnailRule->save();
        }
        return redirect()->to('admin/thumbnail/rule_list');
    }


    // 缩微图设置 编辑配置(包含)
    public function configAndRegenerateEdit()
    {
        $isRunning = $this->isRunning();

        $thumbnailConfig = (new SysSetting())->get(self::SETTING_THUMBNAIL_NAME);
        return view('admin.thumbnail.config', array_merge($thumbnailConfig,
            ['rules'      => $this->rules,
             'types'      => $this->types,
             'is_running' => $isRunning
            ]));
    }

    // 保存缩略图
    public function configSave(ThumbnailConfigRequest $request)
    {
        $thumbnailConfig = $request->only('compress_rate', 'rule', 'max_size_num', 'min_width', 'min_height', 'allow_type');
        if (!array_key_exists($thumbnailConfig['rule'], $this->rules)) {
            return redirect()->back()->withInput()->withErrors(['rule' => ['规则不存在']]);
        }
        try {
            (new SysSetting())->set(self::SETTING_THUMBNAIL_NAME, $thumbnailConfig);
        } catch (\Exception $e) {
            Log::warning($e);
        } catch (\Throwable $e) {
            Log::warning($e);
        } finally {
            return redirect()->to('admin/thumbnail/edit')->with('message',['type'=>'success','content'=>'操作成功']);
        }
    }

    // 重新生成缩略图
    public function regenerate(Request $request)
    {
        $generateConfig = $request->only('type', 'is_delete');

        if (!array_key_exists($generateConfig['type'], $this->types)) {
            return response()->json(["code" => -1, "message" => "请选择正常的分类"]);
        }

        if (!$this->lock()) {
            return response()->json(["code" => -1, "message" => "已发出生成缩微图指令.系统将自动处理.你可以关闭该页面处理其它事务.."]);
        }
        //处理事务
        sleep(5);
        //处理完成
        $this->unlock();
        return response()->json(["code" => 0]);
    }

    protected function isRunning()
    {
        $running = $this->lock();
        $this->unlock();
        return !$running;
    }

    protected function lock()
    {
        $this->fpLock = fopen(storage_path('framework/cache/thumbnail.lock'), 'a+');
        if (!flock($this->fpLock, LOCK_EX | LOCK_NB)) {
            return false;
        }
        return true;
    }

    protected function unlock()
    {
        $this->fpLock && fclose($this->fpLock);
    }

}
