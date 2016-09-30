<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SrvServiceCategory extends Model
{
    public $timestamps = false;

    protected $table = 'srv_service_category';
    protected $fillable = [
        'id','parent_id','category_name','short_name','depth','id_tree'
    ];


    /**
     * 更新字段 id_tree
     *
     * @param int $id
     * @return bool
     * @author dch
     */
    public function updateIdTree($id)
    {
        $categories = SrvServiceCategory::all()->toArray();
        $ids = array_column($categories, 'parent_id', 'id');

        $_id = $id;
        $trees = [];
        $trees[] = $_id;
        for ($i = 0; $i < 100; $i++) {
            if (empty($ids[$_id])) {
                break;
            }
            $_id = $ids[$_id];
            $trees[] = $_id;
        }
        $trees = array_reverse($trees);
        $idTree = sprintf(',%s,', implode(',', $trees));

        return $this->where('id', $id)->update(['id_tree'=> $idTree]);
    }
}