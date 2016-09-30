<?php
/**
 * Class 短信Model
 * @method
 * @package App
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SysSmsTemplate extends Model
{
    protected $table = 'sys_sms_template';

    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $guarded = ['id'];

    protected $fillable = [
        'title', 'content', 'remark', 'status', 'typeid', 'client_base', ''
    ];

    /**
     * 替换单行数据(字段名只能程序指定)
     * @param array $newData
     * @return bool
     */
    public function insert(array $newData, $id)
    {
        if (empty($newData)) {
            throw new \LogicException("参数不能为空");
        }
        return  $id ? $this->where(['id'=>$id])->update($newData) : $this::insertGetId($newData);
    }

    /**
     * 删除模板信息
     * @param $id
     * @return bool
     */
    function  del ($id) {
        if (empty($id)) {
            return false;
        }
        return $this->where(['id'=>$id])->update(['status'=>99]);
    }
}
