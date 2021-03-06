<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('media', function (Blueprint $table) {
            $table->engine = 'InnoDB COMMENT"资源媒体"';
            $table->increments('id');
            $table->string('username')->default('')->comment('用户名');
            $table->integer('userid')->default(0)->comment('所属会员ID');
            $table->integer('avatar')->default(0)->comment('头像');
            $table->tinyInteger('type')->default('1')->comment('资源类别:1直播、2短视频');
            $table->string('platform',100)->default('')->comment('直播平台');
            $table->string('form_money',150)->default('')->comment('展现形式及报价');
            $table->string('homepage')->default('')->comment('平台ID');
            $table->string('room_id')->default('')->comment('房间号');
            $table->string('manner')->default('')->comment('主播风格');
            $table->integer('fan')->default(0)->comment('粉丝数');
            $table->integer('online')->default(0)->comment('直播平均人数');
            $table->integer('bespeak')->default(0)->comment('预约次数');
            $table->integer('accept')->default(0)->comment('接单数');
            $table->integer('refuse')->default(0)->comment('拒单数');
            $table->tinyInteger('level')->default('0')->comment('媒体等级');
            $table->tinyInteger('status')->default('1')->comment('状态:-1删除、0锁定、1正常、2待审核、3未通过');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('media');
    }
}
