<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysAuthRulesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('sys_auth_rule', function (Blueprint $table) {
            $table->engine = 'InnoDB COMMENT="权限规则"';
            $table->increments('id');
            $table->string('title',50)->default('')->comment('用户组中文名称');
            $table->string('name',100)->default('')->comment('规则唯一英文标识');
            $table->tinyInteger('type')->default('1')->comment('类型:1url，2主菜单');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('sys_auth_rule');
    }
}
