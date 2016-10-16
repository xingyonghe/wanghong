<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('article', function (Blueprint $table) {
            $table->engine = 'InnoDB COMMENT"文章"';
            $table->increments('id');
            $table->string('title')->default('')->comment('标题');
            $table->integer('catid')->default(0)->comment('分类ID');
            $table->string('descrition',300)->default('')->comment('描述');
            $table->integer('view')->default(0)->comment('浏览');
            $table->string('author',50)->default('')->comment('作者');
            $table->string('quote')->default('')->comment('来源');
            $table->text('content')->comment('内容');
            $table->tinyInteger('status')->default('1')->comment('状态:-1删除、0锁定、1正常');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('article');
    }
}
