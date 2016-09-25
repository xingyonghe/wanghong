<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysMenusTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('sys_menu', function (Blueprint $table) {
            $table->engine = 'InnoDB COMMENT="系统菜单"';
            $table->increments('id');
            $table->string('title',50)->default('')->comment('标题');
            $table->integer('pid')->default('0')->comment('上级分类ID');
            $table->integer('sort')->default('0')->comment('排序（同级有效）');
            $table->string('url')->default('')->comment('链接地址');
            $table->tinyInteger('hide')->default('0')->comment('是否隐藏:0显示，1隐藏');
            $table->string('class',50)->default('')->comment('class样式名称');
            $table->string('group',50)->default('')->comment('分组');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('sys_menu');
    }
}
