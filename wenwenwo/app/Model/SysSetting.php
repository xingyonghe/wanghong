<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class SysSetting
 * @package App\Model
 * @author dch
 */
class SysSetting extends Model
{
    public $timestamps = false;
    protected $table = 'sys_setting';
    protected $fillable = [
        'id', 'name', 'value',
    ];

    public function get(string $name)
    {
        $value = $this->where("name",$name)->first()['value'] ?? '';
        return json_decode($value,true);
    }

    /**
     * 设置KEY->value
     *
     * @param string $name
     * @param string|array $value
     * @return bool
     * @author dch
     */
    public function set(string $name, $value)
    {
        return $this->replace(['name' => $name, 'value' => is_array($value) ? json_encode($value) : $value]);
    }

    /**
     * 替换单行数据(字段名只能程序指定)
     *
     * @param array $newData
     * @return bool
     */
    public function replace(array $newData)
    {
        if (empty($newData)) {
            throw new \LogicException("参数不能为空");
        }
        if (array_diff(array_keys($newData), $this->fillable)) {
            throw new \LogicException('包含非法字段');
        }
        $valuePlaces = substr(str_repeat("?,", count($newData)), 0, -1);
        $fieldPlaces = sprintf("`%s`", implode("`,`", array_keys($newData)));
        return DB::insert("INSERT INTO {$this->table}({$fieldPlaces}) VALUES({$valuePlaces}) ON DUPLICATE KEY UPDATE `value`=VALUES(`value`)", array_values($newData));
    }

}
