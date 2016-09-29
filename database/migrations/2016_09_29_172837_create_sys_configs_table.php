<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysConfigsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('sys_config', function (Blueprint $table) {
            $table->engine = 'InnoDB COMMENT"网站配置"';
            $table->increments('id');
            $table->string('title',50)->default('')->comment('配置标题');
            $table->string('name',30)->default('')->comment('配置名称');
            $table->integer('sort')->default('0')->comment('排序');
            $table->tinyInteger('type')->default('0')->comment('配置类型:0数字，1字符，2文本，3数组，4枚举，5图片');
            $table->tinyInteger('group')->default('0')->comment('配置分组:0基本设置，1SEO优化');
            $table->string('value',300)->default('')->comment('配置值');
            $table->string('extra',300)->default('')->comment('配置项');
            $table->string('remark',150)->default('')->comment('配置说明');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('sys_config');
    }
}
