<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysChannelsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('sys_channel', function (Blueprint $table){
            $table->engine = 'InnoDB COMMENT"导航"';
            $table->increments('id');
            $table->string('title',50)->comment('导航标题');
            $table->string('url',150)->comment('导航链接');
            $table->integer('sort')->default('0')->comment('排序');
            $table->tinyInteger('status')->default('1')->comment('是否隐藏:1显示，0隐藏');
            $table->tinyInteger('target')->default('0')->comment('是否新窗口打开:0否，1是');
            $table->string('remark',150)->comment('导航备注');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('sys_channel');
    }
}
