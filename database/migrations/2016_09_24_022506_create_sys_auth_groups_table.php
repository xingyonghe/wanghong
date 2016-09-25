<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysAuthGroupsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('sys_auth_group', function (Blueprint $table) {
            $table->engine = 'InnoDB COMMENT="用户组"';
            $table->increments('id');
            $table->string('title',50)->default('')->comment('用户组中文名称');
            $table->string('description',100)->default('')->comment('描述信息');
            $table->tinyInteger('status')->default('1')->comment('用户组状态:0禁用，1正常');
            $table->string('rules',500)->default('')->comment('用户组拥有的规则id，多个规则 , 隔开');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('sys_auth_group');
    }
}
