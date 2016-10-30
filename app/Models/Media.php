<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model{
    protected $table = 'media';
    protected $fillable = [
        'username','userid', 'avatar', 'author', 'quote', 'content'
    ];
    protected $guarded = [
        'id', 'view', 'status', 'created_at', 'updated_at'
    ];



//$table->engine = 'InnoDB COMMENT"资源媒体"';
//$table->increments('id');
//$table->string('username')->default('')->comment('用户名');
//$table->integer('userid')->default(0)->comment('所属会员ID');
//$table->integer('avatar')->default(0)->comment('头像');
//$table->string('descrition',300)->default('')->comment('描述');
//$table->tinyInteger('type')->default('1')->comment('资源类别:1直播、2短视频');
//$table->tinyInteger('form')->default('1')->comment('展现形式');
//$table->string('homepage')->default('')->comment('平台ID');
//$table->decimal('money',10)->comment('预算金额');
//$table->integer('fan')->default(0)->comment('粉丝数');
//$table->integer('online')->default(0)->comment('直播平均人数');
//$table->integer('bespeak')->default(0)->comment('预约次数');
//$table->integer('accept')->default(0)->comment('接单数');
//$table->integer('refuse')->default(0)->comment('拒单数');
//$table->tinyInteger('level')->default('0')->comment('媒体等级');
//$table->tinyInteger('status')->default('1')->comment('状态:-1删除、0锁定、1正常、2待审核、3未通过');
//$table->timestamps();
}
