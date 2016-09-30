<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysSetting
 * @method
 * @package App
 */
class SysSenivive extends Model
{
    /**
     * 敏感词数据集
     * @param array $result
     */
    public function replaceStr(array $result)
    {
        if (empty($result['sensitive_name'])) {
            throw new \LogicException("参数不能为空");
        }
        try {
            $pathUrl = app_path().'/../public/static/mgck.text';
            //$pathUrl = app_path().'/../public/static/mgck_test.text';
            file_put_contents($pathUrl, $result['sensitive_name']);
        } catch (\Exception $e) {
            throw new \Exception($e);
        } finally {
            return true;
        }
    }
}
